<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

readonly class DeleteCategoryService
{

    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function handle(DeleteCategoryRequest $param): void
    {
        $id = $param->id;

        DB::beginTransaction();

        try {
            $this->categoryRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to delete hero');
        }

        DB::commit();
    }
}
