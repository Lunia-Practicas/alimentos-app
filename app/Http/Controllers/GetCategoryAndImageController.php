<?php

namespace App\Http\Controllers;

use App\Services\GetCategoryAndImageRequest;
use App\Services\GetCategoryAndImageService;
use Illuminate\Support\Facades\Http;


class GetCategoryAndImageController extends Controller
{
    public function __construct(private readonly GetCategoryAndImageService $getCategoryAndImageService)
    {

    }

    public function __invoke()
    {
        return $this->getCategoryAndImageService->handle(new GetCategoryAndImageRequest());
    }

}
