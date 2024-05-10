<?php

namespace App\Services;

readonly class CreateProductRequest
{

    public function __construct(public mixed $name,
                                public mixed $category_id,
                                public mixed $weight,
                                public mixed $origin,
                                public mixed $price,
                                public mixed $vegan,
                                public mixed $gluten)
    {

    }
}
