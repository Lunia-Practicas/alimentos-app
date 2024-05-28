<?php

namespace App\Services;

readonly class MakeOrdenAndSendEmailRequest
{
    public function __construct(public mixed $id,
                                public mixed $quantity,
                                public mixed $email,
                                public mixed $note)
    {
    }
}
