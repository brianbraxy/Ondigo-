<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Services\SafeHaven\SafeHavenApiService;
use Carbon\Carbon;
use Illuminate\Support\Str;

class WebhookController extends Controller
{
  public function __construct()
  {
  }

  public function index(Request $request)
  {
    try {
      $txType = [
        "Inwards" => "credit",
        "Outwards" => "debit"
      ];
      $type = $request->data['type'];
      $yesterday = Carbon::yesterday()->format('Y-m-d');
      $today = Carbon::now()->format('Y-m-d');
      $transactions = (new SafeHavenApiService)->get_transactions(
        $request->data['account'],
        "0",
        "1000",
        $yesterday,
        $today,
        $txType[$type]
      );
      if (count($transactions->data) > 0) {
        foreach ($transactions->data as $value) {
          if ($value->account->_id === $request->data['account']) {
            $user = Bank::where(["account_id" => $request->data['account']])->first()->user;
      // return response()->json(['message' => $user], 200);
            $transaction = new Transaction();
            $transaction->uuid = Str::uuid();
            $transaction->total = $request->data['amount'];
            $transaction->status = "success";
            $transaction->user_id = $user->id;
            $transaction->save();

            $user = User::find($user->id);
            $user->balance += $request->data['amount'];
            $user->save();
            break;
          };
        }
      }

      return response()->json(['message' => 'Success'], 200);
    } catch (Exception $e) {
      return response()->json(['message' => $e->getMessage(), 'line' => $e->getLine()], 200);
      return response()->json(['message' => 'Success'], 200);
    }
  }
}
