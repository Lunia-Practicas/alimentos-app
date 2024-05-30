<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderNotifyEmailAdmin;
use App\Mail\OrderNotifyEmailClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;

        $name = $order->name;
        $quantity = $order->quantity;
        $total = $order->total;
        $note = $order->note;
        $email = $order->email;

        Mail::to($email)->send(new OrderNotifyEmailClient($name, $total, $note, $quantity, $email));
        Mail::to('jacain99laravel@gmail.com')->send(new OrderNotifyEmailAdmin($name, $total, $note, $quantity, $email));
    }
}
