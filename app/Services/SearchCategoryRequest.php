<?php

namespace App\Services;

readonly class SearchCategoryRequest
{
    public function __construct(public mixed $name)
    {

    }
}
