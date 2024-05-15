<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\ProductContent;
use App\Models\Product;
use OpenAI;

class DescriptionRepository
{
    protected $description;

    public function __construct(ProductContent $description)
    {
        $this->description = $description;
    }

    public function generate($id)
    {
        $product = Product::findOrFail($id);

        $client = OpenAI::factory()
            ->withBaseUri('https://lunia-openai-sweden.openai.azure.com/openai/deployments/gpt-35-turbo-instruct')
            ->withHttpHeader('api-key', '8a0e1587470a4f57ab4b9fa6acdb3efe')
            ->withQueryParam('api-version', '2024-02-01')
            ->make();

        $response = $client->completions()->create([
            'prompt' => 'Actúa como un redactor publicitario en tiendas online trabajando para un eCommerce que venda productos alimenticios. Dame la descripción para la ficha del siguiente producto usando el name, weight, origin, price, vegan y gluten: '.$product. '. Necesito que sea descriptivo y tenga una extensión de 200 palabras con un tono persuasivo',
            'max_tokens' => 700,
            'temperature' => 0.7
        ]);

        $final = '';
        foreach ($response->choices as $choice) {
            $final .= $choice->text;
        }

        return $final;
    }

    public function create($data)
    {
        $description = ProductContent::create($data);

        $description->fresh();
        return $description;
    }

    public function getDescription($id)
    {
        return ProductContent::where('product_id', $id)->first();
    }

    public function update($id, $data)
    {
        $description = $this->getDescription($id);
        $description->update([
            'description' => $data['description'],
            'title' => $data['title'],
        ]);
        return $description;
    }

    public function generateTitle($id)
    {
        $product = Product::findOrFail($id);

        $client = OpenAI::factory()
            ->withBaseUri('https://lunia-openai-sweden.openai.azure.com/openai/deployments/gpt-35-turbo-instruct')
            ->withHttpHeader('api-key', '8a0e1587470a4f57ab4b9fa6acdb3efe')
            ->withQueryParam('api-version', '2024-02-01')
            ->make();

        $response = $client->completions()->create([
            'prompt' => 'Actúa como un redactor publicitario en tiendas online trabajando para un eCommerce que venda productos alimenticios. Dame el título para la ficha del siguiente producto sin tener en cuenta la fecha de creación y actualización: '.$product. '. Necesito que sea descriptivo y tenga una extensión de máximo 3 palabras con un tono persuasivo',
            'max_tokens' => 700,
            'temperature' => 0.7
        ]);

        $final = '';
        foreach ($response->choices as $choice) {
            $final .= $choice->text;
        }

        return $final;
    }

}
