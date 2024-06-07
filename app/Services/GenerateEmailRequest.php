<?php

namespace App\Services;

readonly class GenerateEmailRequest
{
    public function __construct(public mixed $subjectContent,
                                public mixed $htmlContent)
    {

    }
}
