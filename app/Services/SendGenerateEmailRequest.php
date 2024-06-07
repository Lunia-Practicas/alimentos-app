<?php

namespace App\Services;

readonly class SendGenerateEmailRequest
{
    public function __construct(public mixed $subjectContent,
                                public mixed $htmlContent)
    {

    }
}
