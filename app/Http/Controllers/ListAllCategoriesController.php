<?php

namespace App\Http\Controllers;

use App\Services\ListAllCategoriesRequest;
use App\Services\ListAllCategoriesService;
use Illuminate\Support\Facades\Http;

class ListAllCategoriesController extends Controller
{
    public function __construct(private readonly  ListAllCategoriesService $listAllCategoriesService)
    {

    }

    public function __invoke()
    {
        //dump(auth()->user()->getAttributes());
        $categories = $this->listAllCategoriesService->handle(new ListAllCategoriesRequest());

        return $categories->toJson();
    }
}
