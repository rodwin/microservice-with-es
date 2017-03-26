<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserRegisteredToKafka
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $rk = new \RdKafka\Producer();
        $rk->setLogLevel(LOG_DEBUG);
        $rk->addBrokers("kafka");

        $topic = $rk->newTopic("test");
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, $event->user);
        $rk->poll(0);

        while ($rk->getOutQLen() > 0) {
            $rk->poll(50);
        }

    }
}
