<?php

namespace App\Http\Controllers;

use App\Services\ListAllCategoriesRequest;
use App\Services\ListAllCategoriesService;

class ListAllCategoriesController extends Controller
{
    public function __construct(private readonly  ListAllCategoriesService $listAllCategoriesService)
    {

    }

    public function __invoke()
    {
        $categories = $this->listAllCategoriesService->handle(new ListAllCategoriesRequest());

        return $categories->toJson();
    }
}
