<?php

namespace Tests\Feature;

use App\Http\Controllers\DeleteProductController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteProductTest extends TestCase
{
    use RefreshDatabase;
    private DeleteProductController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(DeleteProductController::class);
    }

    #[Test] public function test_delete_product()
    {
        $category1 = Category::factory()->create();
        $category1->refresh();
        $product1 = Product::factory()->create(['category_id' => $category1->id]);
        $product2 = Product::factory()->create(['category_id' => $category1->id]);

        $product1->refresh();
        $product2->refresh();

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/products/' . $product1->id,
        ]);

        $request->setRouteResolver(function () use ($request, $product1) {
            return (new Route(
                'DELETE',
                'api/products/{id}',
                []
            ))->bind($request);
        });

        $products = $this->controller->__invoke($request);

        $productsData = json_decode($products, true);

        foreach ($productsData as $productData) {
            $this->assertNotEquals($product1->id, $productData['id']);
        }
    }

    #[Test] public function test_delete_product_db()
    {
        $category1 = Category::factory()->create();
        $category1->refresh();
        $product1 = Product::factory()->create(['category_id' => $category1->id]);
        $product2 = Product::factory()->create(['category_id' => $category1->id]);

        $product1->refresh();
        $product2->refresh();

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/products/' . $product1->id,
        ]);

        $request->setRouteResolver(function () use ($request, $product1) {
            return (new Route(
                'DELETE',
                'api/products/{id}',
                []
            ))->bind($request);
        });

        $this->controller->__invoke($request);

        $this->assertDatabaseMissing('products', [
            'id' => $product1->id
        ]);
    }

}
