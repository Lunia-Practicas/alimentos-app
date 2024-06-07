<?php

namespace App\Services;

use App\Repositories\EmailRepository;

class GenerateEmailService
{

    public function __construct(private EmailRepository $emailRepository)
    {
    }

    public function handle(GenerateEmailRequest $param)
    {
        $data = [
          'subjectContent' => $param->subjectContent,
          'htmlContent' => $param->htmlContent,
        ];

        return $this->emailRepository->generateEmail($data);
    }
}
