<?php

namespace App\Events;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;

class EmailCreated
{
    use SerializesModels, DispatchesJobs;
    public string $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

}
