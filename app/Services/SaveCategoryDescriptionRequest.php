<?php

namespace App\Services;

class SaveCategoryDescriptionRequest
{
    public function __construct(public mixed $id, public mixed $description, public mixed $image)
    {

    }
}
