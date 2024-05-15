<?php

namespace App\Services;

class UpdateImageByIdRequest
{
    public function __construct(public mixed $id, public mixed $image)
    {

    }

}
