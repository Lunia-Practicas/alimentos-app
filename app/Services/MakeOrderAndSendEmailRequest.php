<?php

namespace App\Services;

readonly class MakeOrderAndSendEmailRequest
{
    public function __construct(public mixed $id,
                                public mixed $quantity,
                                public mixed $price,
                                public mixed $email,
                                public mixed $note)
    {
    }
}
