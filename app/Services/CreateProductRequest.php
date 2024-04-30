<?php

namespace App\Services;

class CreateProductRequest
{

    public function __construct(public mixed $name,
                                public mixed $weight,
                                public mixed $origin,
                                public mixed $price,
                                public mixed $vegan,
                                public mixed $gluten)
    {

    }
}
