<?php

namespace Tests\Feature;

use App\Http\Controllers\ListAllProductsByCategoryIdController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->category = Category::factory()->create();
        $this->category->fresh();
        $this->controller = $this->app->make(ListAllProductsByCategoryIdController::class);
    }

    #[Test] public function test_list_all_products_by_category_id()
    {

        Product::factory()->create(['category_id' => $this->category->id]);
        Product::factory()->create(['category_id' => $this->category->id]);

        $products = $this->controller->__invoke($this->category->id);

        $productsData = json_decode($products, true);

        $this->assertCount(2, $productsData);
    }
}
