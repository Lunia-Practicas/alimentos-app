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
        $email_content = $event->email_content;

        $email = $email_content->email;
        $name_client = $email_content->name_client;
        $city = $email_content->city;
        $address = $email_content->address;

        $emails = Email::query();

        if (!$emails->where('email', $email)->exists()) {
            Email::create([
                'email' => $email,
                'name_client' => $name_client,
                'city' => $city,
                'address' => $address,
            ]);
        }

    }

}
