<?php

namespace App\Services;

readonly class SearchEmailsRequest
{
    public function __construct(public mixed $id,
                                public mixed $email,
                                public mixed $name_client,
                                public mixed $city,
                                public mixed $address,
                                public mixed $min_date,
                                public mixed $max_date,)
    {
    }
}
