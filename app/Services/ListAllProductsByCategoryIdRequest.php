<?php

namespace App\Services;

readonly class ListAllProductsByCategoryIdRequest
{
    public function __construct(public mixed $id)
    {

    }
}
