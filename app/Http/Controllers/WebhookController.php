<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;
use App\Services\SafeHaven\SafeHavenApiService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Webhook
{
  public function __construct()
  {
  }

  public function index(Request $request)
  {
    try {
      $txType = [
        "Inward" => "credit",
        "Outward" => "debit"
      ];
      $type = $request->type;
      $yesterday = Carbon::yesterday()->format('Y-m-d');
      $today = Carbon::now()->format('Y-m-d');
      $transactions = (new SafeHavenApiService)->get_transactions(
        $request->data->account,
        "0",
        "1000",
        $yesterday,
        $today,
        $txType[$type]
      );
      if ($transactions->data->count > 0) {
        foreach ($transactions->data as $key => $value) {
          if ($key === "account" && $value === $request->data->account) {
            $user = Bank::where("account_id", $request->data->account)->first()->user();
            $transaction = new Transaction();
            $transaction->uuid = Str::uuid();
            $transaction->total = $request->data->amount;
            $transaction->status = "success";
            $transaction->user_id = $user->id;
            $transaction->save();
            break;
          };
        }
      }

      return response()->json(['message' => 'Success'], 200);
    } catch (Exception $e) {
      return response()->json(['message' => 'Success'], 200);
    }
  }
}
