<?php

namespace App\Services;

readonly class CreateEmailTemplateRequest
{
    public function __construct(public mixed $title, public mixed $subject, public mixed $body)
    {
    }

}
