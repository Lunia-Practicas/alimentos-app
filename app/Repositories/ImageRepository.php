<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\Product;
use OpenAI;

class ImageRepository
{

    public function generateImage($id)
    {
        $product = Product::findOrFail($id);

        $client = OpenAI::factory()
            ->withBaseUri('https://lunia-openai-sweden.openai.azure.com/openai/deployments/dall-e-3')
            ->withHttpHeader('api-key', '8a0e1587470a4f57ab4b9fa6acdb3efe')
            ->withQueryParam('api-version', '2024-02-01')
            ->make();

        $response = $client->images()->create([
            'model' => 'dall-e-3',
            'prompt' => 'Dame la imagen de un producto usando el dato name de este objeto: '.$product['name'],
            'n' => 1,
            'size' => '1024x1024',
        ]);

        return $response['data'][0]['url'];
    }

    public function create($data)
    {
        $image = Image::create($data);

        $image->fresh();
        return $image;
    }

    public function getImagesByIdProduct($id)
    {
        return Image::where('product_id', $id)->get();
    }
}
