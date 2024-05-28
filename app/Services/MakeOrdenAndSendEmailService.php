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
            'email' => $param->email,
            'note' => $param->note,
        ];

        $this->ordenRepository->makeOrdenAndSendEmail($data);
    }
}
