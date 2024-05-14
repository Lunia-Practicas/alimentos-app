<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use OpenAI;

class ImageRepository
{

    public function generateImage($id, $prompt)
    {
        $product = Product::findOrFail($id);

        $client = OpenAI::factory()
            ->withBaseUri('https://lunia-openai-sweden.openai.azure.com/openai/deployments/dall-e-3')
            ->withHttpHeader('api-key', '8a0e1587470a4f57ab4b9fa6acdb3efe')
            ->withQueryParam('api-version', '2024-02-01')
            ->make();

        $response = $client->images()->create([
            'model' => 'dall-e-3',
            'prompt' => $prompt.$product['name'],
            'n' => 1,
            'size' => '1024x1024',
        ]);

        return $response['data'][0]['url'];
    }

    public function create($data)
    {

        $urlCerca = $data['imageCerca'];
        $urlLejos = $data['imageLejos'];

        if (!app()->environment('testing')) {

            //Cerca
            $contenidoCerca = file_get_contents($urlCerca);
            $nombreArchivoCerca = $data['product_id'].'Cerca.jpg';

            Storage::disk('public')->put($nombreArchivoCerca, $contenidoCerca);

            $imageCerca = Image::create([
                'product_id' => $data['product_id'],
                'image' => $nombreArchivoCerca,
            ]);
            $imageCerca->fresh();

            //Lejos
            $contenidoLejos = file_get_contents($urlLejos);
            $nombreArchivoLejos = $data['product_id'].'Lejos.jpg';

            Storage::disk('public')->put($nombreArchivoLejos, $contenidoLejos);

            $imageLejos = Image::create([
                'product_id' => $data['product_id'],
                'image' => $nombreArchivoLejos,
            ]);
            $imageLejos->fresh();

            return [
                'imageCerca' => $imageCerca,
                'imageLejos' => $imageLejos
            ];


        }else{
            $imageCerca = Image::create([
                'product_id' => $data['product_id'],
                'image' => $data['imageCerca']
            ]);
            $imageLejos = Image::create([
                'product_id' => $data['product_id'],
                'image' => $data['imageLejos']
            ]);

            return [
                'imageCerca' => $imageCerca,
                'imageLejos' => $imageLejos
            ];
        }
    }

    public function getImagesByIdProduct($id)
    {
        return Image::where('product_id', $id)->get();
    }
}
