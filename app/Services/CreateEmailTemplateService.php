<?php

namespace App\Services;

use App\Repositories\EmailTemplateRepository;

readonly class CreateEmailTemplateService
{

    public function __construct(private EmailTemplateRepository $emailTemplateRepository)
    {
    }

    public function handle(CreateEmailTemplateRequest $param)
    {
        $data = [
            'title' => $param->title,
            'subject' => $param->subject,
            'body' => $param->body,
        ];

        return $this->emailTemplateRepository->create($data);
    }
}
