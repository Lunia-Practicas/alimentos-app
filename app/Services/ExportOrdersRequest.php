<?php

namespace App\Services;

readonly class ExportOrdersRequest
{
    public function __construct(public mixed $order_num,
                                public mixed $email,
                                public mixed $product_name,
                                public mixed $category_id,
                                public mixed $note,
                                public mixed $quantity,
                                public mixed $min_date,
                                public mixed $max_date)
    {

    }
}
