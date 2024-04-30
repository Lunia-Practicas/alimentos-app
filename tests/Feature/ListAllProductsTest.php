<?php

namespace Tests\Feature;

use App\Http\Controllers\ListAllProductsController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ListAllProductsTest extends TestCase
{
    use RefreshDatabase;
    private ListAllProductsController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(ListAllProductsController::class);
    }

    #[Test] public function test_list_all_products()
    {
        $category = Category::factory()->create();
        Product::factory()->create(['category_id' => $category->id]);
        Product::factory()->create(['category_id' => $category->id]);
        Product::factory()->create(['category_id' => $category->id]);

        $products = $this->controller->__invoke();
        $categoriesData = json_decode($products, true);

        $this->assertCount(3, $categoriesData);
    }
}
