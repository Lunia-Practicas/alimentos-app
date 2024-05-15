<?php

namespace App\Services;

use App\Repositories\CategoryContentRepository;
use Illuminate\Support\Facades\Storage;

readonly class GetCategoryContentService
{

    public function __construct(private CategoryContentRepository $categoryContentRepository)
    {

    }

    public function handle(GetCategoryContentRequest $param)
    {
        $id = $param->id;

        $categoryContent =  $this->categoryContentRepository->getCategoryContent($id);

        return [
            'id' => $categoryContent['id'],
            'category_id' => $categoryContent['category_id'],
            'description' => $categoryContent['description'],
            'image' => Storage::url($categoryContent['image'])
        ];
    }
}
