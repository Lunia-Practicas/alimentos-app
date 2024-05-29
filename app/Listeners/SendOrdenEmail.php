<?php

namespace App\Listeners;

use App\Events\OrdenCreated;
use App\Mail\OrdenNotifyEmailAdmin;
use App\Mail\OrdenNotifyEmailClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrdenEmail implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     */
    public function handle(OrdenCreated $event)
    {
        $orden = $event->orden;

        $name = $orden->name;
        $quantity = $orden->quantity;
        $total = $orden->total;
        $note = $orden->note;
        $email = $orden->email;

        Mail::to($email)->send(new OrdenNotifyEmailClient($name, $total, $note, $quantity, $email));
        Mail::to('jacain99laravel@gmail.com')->send(new OrdenNotifyEmailAdmin($name, $total, $note, $quantity, $email));
    }
}
