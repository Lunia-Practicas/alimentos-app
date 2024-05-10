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

    public function handle(UpdateCategoryRequest $request)
    {
        $id = $request->id;
        $id_updated = $request->id_updated;
        $data = [
            'name' => $request->name,
            'updated_by' => $id_updated,
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
