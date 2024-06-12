<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateImageController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GenerateImageTest extends TestCase
{
    use RefreshDatabase;
    private GenerateImageController $controller;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GenerateImageController::class);
        $this->category = Category::factory()->create();
    }

    #[Test] public function test_generate_image()
    {
        $product = Product::factory()->create(['category_id' => $this->category->id]);

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/products/image/' . $product->id,
        ]);

        $request->setRouteResolver(function () use ($request, $product) {
            return (new Route(
                'GET',
                'api/products/image/{id}',
                []
            ))->bind($request);
        });
        sleep(15);

        $response = $this->controller->__invoke($request);

        $this->assertArrayHasKey('imageCerca', $response);
        $this->assertArrayHasKey('imageLejos', $response);
        $this->assertNotNull($response['imageLejos']);
        $this->assertNotNull($response['imageCerca']);
    }
}
