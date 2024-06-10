<?php

namespace App\Services;

use App\Repositories\EmailTemplateRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

readonly class DeleteEmailTemplateService
{

    public function __construct(private EmailTemplateRepository $emailTemplateRepository)
    {
    }

    public function handle(DeleteEmailTemplateRequest $param)
    {
        $id = $param->id;

        DB::beginTransaction();

        try {
            $this->emailTemplateRepository->delete($id);
        } catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete template.');
        }

        DB::commit();
    }
}
