<?php

namespace App\Services;

readonly class UpdateCategoryRequest
{
    public function __construct(public mixed $name)
    {

    }
}
