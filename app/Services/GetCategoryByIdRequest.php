<?php

namespace App\Services;

readonly class GetCategoryByIdRequest
{
    public function __construct(public mixed $id)
    {

    }
}
