<?php

namespace App\Services;

readonly class DeleteCategoryRequest
{
    public function __construct(public mixed $id)
    {

    }
}
