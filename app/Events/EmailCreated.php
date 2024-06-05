<?php

namespace App\Events;

use App\DTO\EmailInformationDTO;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;

class EmailCreated
{
    use SerializesModels, DispatchesJobs;
    public $email_content;

    public function __construct(EmailInformationDTO $email_content)
    {
        $this->email_content = $email_content;
    }

}
