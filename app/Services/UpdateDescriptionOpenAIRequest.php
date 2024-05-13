<?php

namespace App\Services;

class UpdateDescriptionOpenAIRequest
{
    public function __construct(public mixed $id, public mixed $description, public mixed $title)
    {

    }

}
