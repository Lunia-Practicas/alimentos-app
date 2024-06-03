<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class GenerateOrderPdfService
{

    public function __construct(private OrderRepository $orderRepository)
    {
    }

    public function handle(GenerateOrderPdfRequest $param)
    {
        $data = [
            'order_num' => $param->order_num,
        ];

        return $this->orderRepository->generateOrderPdf($data);
    }
}
