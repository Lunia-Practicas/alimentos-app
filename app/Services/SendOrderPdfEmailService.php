<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Mail;

class SendOrderPdfEmailService
{

    public function __construct(private OrderRepository $orderRepository)
    {

    }

    public function handle(SendOrderPdfEmailRequest $param)
    {
        $data = [
            'order_num' => $param->order_num,
        ];

        return $this->orderRepository->sendOrderPdfEmail($data);



    }
}
