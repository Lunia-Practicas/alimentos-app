<?php

namespace App\Services;

class SearchProductRequest
{
    public function __construct(public mixed $name,
                                public mixed $origin,
                                public mixed $vegan,
                                public mixed $gluten,
                                public mixed $category_id,
                                public mixed $min_price,
                                public mixed $max_price,
                                public mixed $min_weight,
                                public mixed $max_weight)
    {
    }
}
