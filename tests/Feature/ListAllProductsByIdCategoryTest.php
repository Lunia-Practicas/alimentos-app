<?php

namespace Tests\Feature;

use App\Http\Controllers\ListAllProductsByCategoryIdController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ListAllProductsByIdCategoryTest extends TestCase
{
    use RefreshDatabase;
    private Category $category;
    private ListAllProductsByCategoryIdController $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = $this->app->make(ListAllProductsByCategoryIdController::class);
    }

    #[Test] public function test_list_all_products_by_category_id()
    {
        $category = Category::factory()->create();

        Product::factory()->create(['category_id' => $category->id]);
        Product::factory()->create(['category_id' => $category->id]);

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/products/' . $category->id,
        ]);

        $request->setRouteResolver(function () use ($request, $category) {
            return (new Route(
                'GET',
                'api/categories/products/{id}',
                []
            ))->bind($request);
        });

        $products = $this->controller->__invoke($request);

        $productsData = json_decode($products, true);

        $this->assertCount(2, $productsData);
    }
}
