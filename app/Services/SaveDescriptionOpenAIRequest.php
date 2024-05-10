<?php

namespace App\Services;

class SaveDescriptionOpenAIRequest
{

    public function __construct(public mixed $id, public mixed $description)
    {

    }
}
