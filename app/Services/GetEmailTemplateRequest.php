<?php

namespace App\Services;

readonly class GetEmailTemplateRequest
{
    public function __construct(public mixed $id)
    {
    }

}
