<?php

namespace App\Services;

readonly class GetProductByIdRequest
{
    public function __construct(public mixed $id)
    {

    }
}
