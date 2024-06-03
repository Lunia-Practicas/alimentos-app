<?php

namespace App\Services;

class SendOrderPdfEmailRequest
{
    public function __construct(public mixed $order_num)
    {
    }
}
