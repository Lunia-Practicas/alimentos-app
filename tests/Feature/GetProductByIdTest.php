<?php

namespace Tests\Feature;

use App\Http\Controllers\GetProductByIdController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetProductByIdTest extends TestCase
{
    use RefreshDatabase;
    private GetProductByIdController $controller;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GetProductByIdController::class);
        $this->category = Category::factory()->create();
        $this->category->fresh();
    }

    #[Test] public function test_get_product_by_id()
    {
        $productA = Product::factory()->create(['category_id' => $this->category->id]);
        $productB = Product::factory()->create(['category_id' => $this->category->id]);

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/products/' . $productA->id,
        ]);

        $request->setRouteResolver(function () use ($request, $productA) {
            return (new Route(
                'GET',
                'api/products/{id}',
                []
            ))->bind($request);
        });

        $response = $this->controller->__invoke($request);
        $responseData = json_decode($response, true);

        $this->assertEquals($productA->id, $responseData['id']);
        $this->assertEquals($productA->name, $responseData['name']);

        $this->assertNotEquals($productB->id, $responseData['id']);
        $this->assertNotEquals($productB->name, $responseData['name']);
    }
}
