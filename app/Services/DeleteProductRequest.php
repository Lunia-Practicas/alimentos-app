<?php

namespace App\Services;

readonly class DeleteProductRequest
{
    public function __construct(public mixed $id)
    {

    }
}
