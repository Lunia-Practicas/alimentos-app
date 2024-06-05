<?php

namespace App\Services;

readonly class MakeOrderAndSendEmailRequest
{
    public function __construct(public mixed $id,
                                public mixed $quantity,
                                public mixed $price,
                                public mixed $email,
                                public mixed $note,
                                public mixed $name_client,
                                public mixed $city,
                                public mixed $address,)
    {
    }
}
