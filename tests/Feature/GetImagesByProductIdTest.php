<?php

namespace Tests\Feature;

use App\Http\Controllers\GetImagesByProductIdController;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetImagesByProductIdTest extends TestCase
{
    use RefreshDatabase;
    private GetImagesByProductIdController $controller;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GetImagesByProductIdController::class);
        $this->category = Category::factory()->create();
    }

    #[Test] public function test_get_images_by_product_id()
    {
        $product = Product::factory()->create(['category_id' => $this->category->id]);

        Image::factory()->create(['product_id' => $product->id]);
        Image::factory()->create(['product_id' => $product->id]);

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/products/images/' . $product->id,
        ]);

        $request->setRouteResolver(function () use ($request, $product) {
            return (new Route(
                'GET',
                'api/products/images/{id}',
                []
            ))->bind($request);
        });

        $response = $this->controller->__invoke($request);

        $data = json_decode($response, true);
        $this->assertCount(2, $data);
    }
}
