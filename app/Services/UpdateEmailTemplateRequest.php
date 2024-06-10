<?php

namespace App\Services;

readonly class UpdateEmailTemplateRequest
{
    public function __construct(public mixed $id,
                                public mixed $title,
                                public mixed $subject,
                                public mixed $body)
    {
    }

}
