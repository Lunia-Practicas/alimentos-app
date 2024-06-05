<?php

namespace App\Services;

use App\Repositories\EmailRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class DeleteEmailService
{

    public function __construct(private EmailRepository $emailRepository)
    {
    }

    public function handle(DeleteEmailRequest $param)
    {
        $id = $param->id;

        DB::beginTransaction();

        try {
            $this->emailRepository->deleteEmail($id);
        } catch (Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());

            throw new InvalidArgumentException('Unable to delete email.');
        }

        DB::commit();

    }
}
