<?php

namespace App\Services;

use App\Repositories\EmailTemplateRepository;

readonly class GetAllEmailTemplateService
{

    public function __construct(private EmailTemplateRepository $emailTemplateRepository)
    {
    }

    public function handle(GetAllEmailTemplateRequest $param)
    {
        return $this->emailTemplateRepository->getAll();
    }
}
