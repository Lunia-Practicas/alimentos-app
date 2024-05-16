<?php

namespace App\Services;

class UpdateCategoryContentRequest
{
    public function __construct(public mixed $id, public mixed $description,public mixed $image)
    {

    }
}
