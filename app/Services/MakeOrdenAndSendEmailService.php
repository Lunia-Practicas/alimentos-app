<?php

namespace App\Services;

use App\Repositories\OrdenRepository;

class MakeOrdenAndSendEmailService
{

    public function __construct(private OrdenRepository $ordenRepository)
    {

    }

    public function handle(MakeOrdenAndSendEmailRequest $param)
    {
        $data = [
            'id' => $param->id,
            'quantity' => $param->quantity,
            'price' => $param->price,
            'email' => $param->email,
            'note' => $param->note,
        ];

        return $this->ordenRepository->makeOrdenAndSendEmail($data);
    }
}
