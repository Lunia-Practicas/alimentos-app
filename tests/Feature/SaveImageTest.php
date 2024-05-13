<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateImageController;
use App\Http\Controllers\SaveImageController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SaveImageTest extends TestCase
{
    use RefreshDatabase;
    private GenerateImageController $controllerA;
    private SaveImageController $controllerB;

    private Category $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->controllerA = $this->app->make(GenerateImageController::class);
        $this->controllerB = $this->app->make(SaveImageController::class);
        $this->category = Category::factory()->create();
        $this->category->fresh();
    }

    #[Test] public function test_create_image()
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

        $imageUrl = $this->controllerA->__invoke($request);

        $request2 = new Request([
            'image' => implode(",", $imageUrl),
        ],[],[],[],[],[
            'REQUEST_URI' => 'api/products/image/' . $product->id,
        ]);

        $request2->setRouteResolver(function () use ($request2, $product) {
            return (new Route(
                'POST',
                'api/products/image/{id}',
                []
            ))->bind($request2);
        });

        $this->controllerB->__invoke($request2);

        $this->assertDatabaseHas('images', [
            'image' => implode(",", $imageUrl),
            'product_id' => $product->id,
        ]);

    }

}
