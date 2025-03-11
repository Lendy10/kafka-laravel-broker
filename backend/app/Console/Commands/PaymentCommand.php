<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class PaymentCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:payment-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send a block of event containing payment to process to kafka broker';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // generate an event to send to kafka
        $event = new \App\Events\PaymentEvent();
        $event->setPaymentId(1);
        $event->setPaymentAmount(100);

        $message = new Message(
            headers: ['header-key' => 'set-x-code'],
            body: [$event]
        );

        // send the event to kafka
        $producer = Kafka::publish()
            ->withDebugEnabled()
            ->onTopic('payment')
            ->withMessage($message);

        $producer->send();
    }
}
