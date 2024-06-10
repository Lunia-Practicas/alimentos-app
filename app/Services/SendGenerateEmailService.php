<?php

namespace App\Services;

use App\Repositories\EmailRepository;

class SendGenerateEmailService
{
    public function __construct(private EmailRepository $emailRepository)
    {
    }

    public function handle(SendGenerateEmailRequest $param)
    {
        $data = [
            'subjectContent' => $param->subjectContent,
            'htmlContent' => $param->htmlContent,
        ];

        return $this->emailRepository->sendGenerateEmail($data);
    }
}
