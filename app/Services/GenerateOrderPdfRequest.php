<?php

namespace App\Services;

readonly class GenerateOrderPdfRequest
{

    public function __construct(public mixed $order_num)
    {
    }

}
