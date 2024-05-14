<?php

namespace App\Http\Controllers;

use App\Services\SaveImageRequest;
use App\Services\SaveImageService;
use Illuminate\Http\Request;

class SaveImageController extends Controller
{
    public function __construct(private readonly SaveImageService  $saveImageService)
    {

    }

    public function __invoke(Request $request): array
    {
        return $this->saveImageService->handle(new SaveImageRequest(
            $request->route('id'),
            $request->input('imageCerca'),
            $request->input('imageLejos')
        ));

        // return ['imageCerca' => $imageCerca, 'imageLejos' => $imageLejos]
    }
}
