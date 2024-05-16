<?php

namespace App\Services;

use App\Repositories\CategoryContentRepository;
use http\Exception\InvalidArgumentException;
use Illuminate\Support\Facades\DB;

class UpdateCategoryContentService
{

    public function __construct(private CategoryContentRepository $categoryContentRepository)
    {

    }

    public function handle(UpdateCategoryContentRequest $param)
    {

        $data = [
            'id' => $param->id,
            'description' => $param->description,
            'image' => $param->image
        ];

        DB::beginTransaction();

        try {
            $categoryContent = $this->categoryContentRepository->update($data);
        } catch (\Exception $e) {
            DB::rollBack();
            throw new InvalidArgumentException('Unable to update category content');
        }

        DB::commit();
        return $categoryContent;
    }
}
