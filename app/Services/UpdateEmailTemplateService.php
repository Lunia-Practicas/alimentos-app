<?php

namespace App\Services;

use App\Repositories\EmailTemplateRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

readonly class UpdateEmailTemplateService
{

    public function __construct(private EmailTemplateRepository $emailTemplateRepository)
    {
    }

    public function handle(UpdateEmailTemplateRequest $param)
    {
        $id = $param->id;

        $data = [
            'title' => $param->title,
            'subject' => $param->subject,
            'body' => $param->body,
        ];

        DB::beginTransaction();

        try {
            $emailTemplate = $this->emailTemplateRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            throw new InvalidArgumentException('Unable to update template');
        }

        DB::commit();
        return $emailTemplate;
    }
}
