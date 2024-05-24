<?php

namespace App\Services;

readonly class SearchProductsNameImageRequest
{
    public function __construct(public mixed $id,
                                public mixed $offset,
                                public mixed $limit)
    {

    }

}
