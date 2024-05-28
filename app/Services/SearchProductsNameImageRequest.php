<?php

namespace App\Services;

readonly class SearchProductsNameImageRequest
{
    public function __construct(public mixed $id,
                                public mixed $offset,
                                public mixed $limit,
                                public mixed $minPrice,
                                public mixed $maxPrice,
                                public mixed $minWeight,
                                public mixed $maxWeight,
                                public mixed $vegan,
                                public mixed $gluten,)
    {

    }

}
