<?php

namespace App\Services;

readonly class CreateCategoryRequest
{
    public function __construct(public mixed $name)
    {
    }
}
