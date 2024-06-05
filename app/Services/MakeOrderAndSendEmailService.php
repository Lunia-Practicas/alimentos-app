<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class MakeOrderAndSendEmailService
{

    public function __construct(private OrderRepository $ordenRepository)
    {

    }

    public function handle(MakeOrderAndSendEmailRequest $param)
    {
        $data = [
            'id' => $param->id,
            'quantity' => $param->quantity,
            'price' => $param->price,
            'email' => $param->email,
            'note' => $param->note,
            'name_client' => $param->name_client,
            'city' => $param->city,
            'address' => $param->address,
        ];

        return $this->ordenRepository->makeOrdenAndSendEmail($data);
    }
}
