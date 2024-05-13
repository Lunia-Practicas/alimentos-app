<?php

namespace App\Http\Controllers;

use App\Services\GetImagesByProductIdRequest;
use App\Services\GetImagesByProductIdService;
use Illuminate\Http\Request;

class GetImagesByProductIdController extends Controller
{
    public function __construct(private readonly GetImagesByProductIdService $getImagesByIdService)
    {

    }

    public function __invoke(Request $request)
    {
        return $this->getImagesByIdService->__handle(new GetImagesByProductIdRequest(
            $request->route('id')
        ));
    }
}
