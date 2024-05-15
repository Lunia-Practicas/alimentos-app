<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateImageDescriptionController;
use App\Models\Category;
use App\Models\Image;
use App\Models\ProductContent;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GenerateImageDescriptionTest extends TestCase
{
    use RefreshDatabase;
    private GenerateImageDescriptionController $controller;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GenerateImageDescriptionController::class);
        $this->category = Category::factory()->create();
    }

    #[Test] public function test_generate_image_description()
    {
        $product = Product::factory()->create(['category_id' => $this->category->id]);
        ProductContent::factory()->create(['product_id' => $product->id]);
        $image = Image::factory()->create(['product_id' => $product->id]);

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/products/image/description/' . $image->id,
        ]);

        $request->setRouteResolver(function () use ($request, $image) {
            return (new Route(
                'GET',
                'api/products/image/description/{id}',
                []
            ))->bind($request);
        });

        $response = $this->controller->__invoke($request);

        $this->assertArrayHasKey('image', $response);
        $this->assertNotNull($response['image']);

    }
}
