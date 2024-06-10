<?php

namespace App\Services;

use App\Repositories\EmailTemplateRepository;

readonly class GetEmailTemplateService
{

    public function __construct(private EmailTemplateRepository $emailTemplateRepository)
    {
    }

    public function handle(GetEmailTemplateRequest $param)
    {
        $data = [
            'id' => $param->id,
        ];

        return $this->emailTemplateRepository->get($data);
    }
}
