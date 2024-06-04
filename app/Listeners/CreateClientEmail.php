<?php

namespace App\Listeners;

use App\Events\EmailCreated;
use App\Models\Email;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateClientEmail implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(EmailCreated $event)
    {
        $email = $event->email;

        $emails = Email::query();

        if (!$emails->where('email', $email)->exists()) {
            Email::create([
                'email' => $email
            ]);
        }

    }

}
