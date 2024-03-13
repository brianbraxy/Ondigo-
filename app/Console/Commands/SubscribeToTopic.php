<?php

namespace App\Console\Commands;

use App\Http\Controllers\TransactionController;
use Illuminate\Console\Command;
use PhpMqtt\Client\Facades\MQTT;

class SubscribeToTopic extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'mqtt:subscribe';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Subscribe To MQTT topic';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $mqtt = MQTT::connection();
    //   $mqtt->publish('/projx/inbound', json_encode([
    //     'key1' => 'value1',
    //     'key2' => 'value2',
    // ]));
    //   $mqtt->disconnect();
    function is_serialized($data)
    {
      return ($data === serialize(false) || @unserialize($data) !== false);
    }
    $mqtt->subscribe('/projx/outbound', function (string $topic, string $message) {
      if (is_serialized($message)) {
        $transaction = new TransactionController();
        $transaction->processTransaction(unserialize($message));
      }
    });

    $mqtt->loop(true);
    return Command::SUCCESS;
  }
}
