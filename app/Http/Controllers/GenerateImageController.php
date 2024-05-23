<?php

namespace App\Http\Controllers;

use App\Services\GenerateImageRequest;
use App\Services\GenerateImageService;
use Illuminate\Http\Request;

class GenerateImageController extends Controller
{
    public function __construct(private readonly GenerateImageService  $generateImageService)
    {

    }

    public function __invoke(Request $request): array
    {
        $imageLejos =  $this->generateImageService->handle(new GenerateImageRequest(
            $request->route('id')), 'Dame la ilustración detallada que representa a este producto alimentario que se encuentra encima de una estantería, que tenga el fondo blanco y  usando el dato name de este objeto: '
        );
        sleep(15);

        $imageCerca = $this->generateImageService->handle(new GenerateImageRequest(
            $request->route('id')), 'Dame la ilustración detallada que representa a este producto alimentario desde cerca, que tenga el fondo blanco y usando el dato name de este objeto: '
        );

        return [
            'imageLejos' => $imageLejos,
            'imageCerca' => $imageCerca
        ];


    }
}
