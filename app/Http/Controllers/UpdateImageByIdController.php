<?php

namespace App\Http\Controllers;

use App\Services\UpdateImageByIdRequest;
use App\Services\UpdateImageByIdService;
use Illuminate\Http\Request;

class UpdateImageByIdController extends Controller
{
    public function __construct(private readonly UpdateImageByIdService $updateImageByIdService)
    {

    }

    public function __invoke(Request $request)
    {
        return $this->updateImageByIdService->handle(new UpdateImageByIdRequest(
            $request->route('id'),
            $request->input('image')
        ));

    }
}
