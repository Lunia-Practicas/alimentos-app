<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\CategoryContent;
use App\Models\ProductContent;
use Illuminate\Support\Facades\Storage;
use OpenAI;

class CategoryContentRepository
{
    public function generateCategoryImage($id)
    {
        $category = Category::findOrFail($id);

        $client = OpenAI::factory()
            ->withBaseUri('https://lunia-openai-sweden.openai.azure.com/openai/deployments/dall-e-3')
            ->withHttpHeader('api-key', '8a0e1587470a4f57ab4b9fa6acdb3efe')
            ->withQueryParam('api-version', '2024-02-01')
            ->make();

        $response = $client->images()->create([
            'model' => 'dall-e-3',
            'prompt' => 'Dame la ilustración detallada que represente a esta categoría, que tenga fondo blanco, usando el dato name de este objeto: '.$category,
            'n' => 1,
            'size' => '1024x1024',
        ]);

        return $response['data'][0]['url'];
    }

    public function generateCategoryDescription($id)
    {
        $category = Category::findOrFail($id);

        $client = OpenAI::factory()
            ->withBaseUri('https://lunia-openai-sweden.openai.azure.com/openai/deployments/gpt-35-turbo-instruct')
            ->withHttpHeader('api-key', '8a0e1587470a4f57ab4b9fa6acdb3efe')
            ->withQueryParam('api-version', '2024-02-01')
            ->make();

        $response = $client->completions()->create([
            'prompt' => 'Actúa como un redactor publicitario en tiendas online trabajando para un eCommerce que venda productos alimenticios. Dame la descripción para la ficha de la siguiente categoría usando el name: '.$category. '. Necesito que sea descriptivo y tenga una extensión de 100 palabras con un tono persuasivo',
            'max_tokens' => 700,
            'temperature' => 0.7
        ]);

        $final = '';
        foreach ($response->choices as $choice) {
            $final .= $choice->text;
        }

        return $final;
    }

    public function saveCategoryDescriptionImage($data)
    {
        $url = $data['image'];
        $category = Category::findOrFail($data['id']);

        if (!app()->environment('testing')) {
            $content = file_get_contents($url);
            $nameFile = 'category'.$data['id'].'.jpg';

            $categoryContent = CategoryContent::create([
                'category_id' => $category->id,
                'description' => $data['description'],
                'image' => $nameFile
            ]);
            $categoryContent->fresh();

            Storage::disk('public')->put($nameFile, $content);

            return $categoryContent;
        }else {

            $categoryContent = CategoryContent::create([
                'category_id' => $category->id,
                'description' => $data['description'],
                'image' => $data['image']
            ]);

            $categoryContent->fresh();

            return $categoryContent;
        }


    }

    public function getCategoryContent($id)
    {
        return CategoryContent::where('category_id', $id)->first();
    }

    public function update($data)
    {
        $categoryContent = $this->getCategoryContent($data['id']);
        $url = $data['image'];

        if (!app()->environment('testing')) {
            if (Storage::disk('public')->exists($categoryContent->image)) {
                $contenido = file_get_contents($url);
                Storage::disk('public')->put($categoryContent->image, $contenido);
            }
        }

        $categoryContent->update([
            'description' => $data['description']
        ]);

        return $categoryContent;

    }

    public function getCategoryAndImage(): array
    {
        $categories = Category::all();

        $resp = [];
        foreach ($categories as $category) {
            $categoryContent = $this->getCategoryContent($category->id);

            $resp[] = [
                'name' => $category->name,
                'category_id' => $category->id,
                'image' => $categoryContent->image ?? null
            ];
        }

        return $resp;
    }

    public function search($request)
    {
        $categories = Category::query();

        if(!is_null($request['name'])){
            $categories->where('name', 'LIKE', "%{$request['name']}%");
        }
        $categories = $categories->get();

        $resp = [];
        foreach ($categories as $category) {
            $categoryContent = $this->getCategoryContent($category->id);

            $resp[] = [
                'name' => $category->name,
                'category_id' => $category->id,
                'image' => $categoryContent->image ?? null
            ];
        }

        return $resp;
    }
}
