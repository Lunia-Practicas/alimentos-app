<?php

namespace App\Services;

class SearchProductRequest
{
    public function __construct(public mixed $name,
                                public mixed $origin,
                                public mixed $vegan,
                                public mixed $gluten)
    {
    }
}
