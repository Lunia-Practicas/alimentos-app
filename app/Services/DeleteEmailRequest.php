<?php

namespace App\Services;

readonly class DeleteEmailRequest
{
    public function __construct(public mixed $id)
    {
    }
}
