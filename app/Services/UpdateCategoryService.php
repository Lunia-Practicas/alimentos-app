<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

readonly class UpdateCategoryService
{

    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    public function handle(UpdateCategoryRequest $request, $id)
    {
        $data = [
            'name' => $request->name,
        ];

        DB::beginTransaction();

        try{
            $category = $this->categoryRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            throw new InvalidArgumentException('Unable to update hero');
        }

        DB::commit();

        return $category;
    }
}
