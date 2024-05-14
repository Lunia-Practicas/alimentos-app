<?php

namespace App\Services;

readonly class SaveImageRequest
{
    public function __construct(public mixed $id, public mixed $imageCerca, public mixed $imageLejos)
    {

    }
}
