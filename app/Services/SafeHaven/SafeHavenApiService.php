<?php

namespace App\Services\SafeHaven;

use \Illuminate\Support\Facades\Http;

class SafeHavenApiService
{
  function getCredentials()
  {
    $body = [
      "grant_type" => "client_credentials",
      "client_assertion_type" => "urn:ietf:params:oauth:client-assertion-type:jwt-bearer",
      "client_assertion" => ENV("SAFE_HAVEN_CLIENT_ASSERTION"),
      "client_id" => env("SAFE_HAVEN_CLIENT_ID")
    ];
    $response = Http::post(env("SAFE_HAVEN_URL") . "/oauth2/token", $body);
    // dd($response);
    return json_decode($response->getBody());
  }

  public function create_account($user)
  {
    $credentials = self::getCredentials();
    $url = env("SAFE_HAVEN_URL") . "/accounts";
    $body = [
      'accountType' => "Savings",
      "suffix" => $user->first_name . ' ' . $user->last_name
    ];
    $headers = [
      'ClientID' => env("SAFE_HAVEN_CLIENT_ID"),
      'accept' => 'application/json',
      'authorization' => 'Bearer ' . $credentials->access_token,
      'content-type' => 'application/json',
    ];
    $response = Http::withHeaders($headers)->post(
      $url,
      $body
    );
    $responseData = json_decode($response->getBody());
    return $responseData;
  }

  public function get_transactions($id, $page, $limit, $fromDate = null, $toDate = null, $type = null)
  {
    $credentials = self::getCredentials();
    $url = env("SAFE_HAVEN_URL") . "/accounts/" . $id . "/statement?page=0&limit=10";
    $headers = [
      'ClientID' => env("SAFE_HAVEN_CLIENT_ID"),
      'accept' => 'application/json',
      'authorization' => 'Bearer ' . $credentials->access_token,
      'content-type' => 'application/json',
    ];
    $response = Http::withHeaders($headers)->get(
      $url,
      [
        "page" => $page,
        "limit" => $limit,
        "fromDate" => $fromDate,
        "toDate" => $toDate,
        "type" => $type
      ]
    );
    $responseData = json_decode($response->getBody());
    return $responseData;
  }
}
