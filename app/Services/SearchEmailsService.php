<?php

namespace App\Services;

use App\Repositories\EmailRepository;
use Carbon\Carbon;

readonly class SearchEmailsService
{

    public function __construct(private EmailRepository $emailRepository)
    {
    }

    public function handle(SearchEmailsRequest $param)
    {
        $data = [
            'id' => $param->id,
            'email' => $param->email,
            'name_client' => $param->name_client,
            'city' => $param->city,
            'address' => $param->address,
            'min_date' => $param->min_date,
            'max_date' => $param->max_date,
        ];

        $resultEmails = [];

        $emails = $this->emailRepository->searchEmails($data);

        foreach ($emails as $email) {
            $resultEmails[] = [
                'id' => $email->id,
                'email' => $email->email,
                'name_client' => $email->name_client,
                'city' => $email->city,
                'address' => $email->address,
                'created_at' => $email->created_at,
            ];
        }

        return $resultEmails;


    }
}
