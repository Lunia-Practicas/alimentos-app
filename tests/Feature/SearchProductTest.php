<?php

namespace Tests\Feature;

use App\Http\Controllers\SearchProductController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SearchProductTest extends TestCase
{
   use RefreshDatabase;
   private Request $request;
   private Category $category;

   private SearchProductController $controller;

   protected function setUp(): void
   {
       parent::setUp();
       $this->category = Category::factory()->create();
       $this->controller = $this->app->make(SearchProductController::class);
   }

   #[Test] public function test_search_product_one_field()
   {
       Product::factory()->create([
           'name' => 'test',
           'category_id' => $this->category->id
       ]);

       Product::factory()->create([
           'name' => 'other',
           'category_id' => $this->category->id
       ]);

       $request = new Request([
           'name' => 'test',
       ]);

       $products = $this->controller->__invoke($request);

       $this->assertCount(1, $products);
   }

   #[Test] public function test_search_product_multiple_field()
   {
       $categoryB = Category::factory()->create();

       Product::factory()->create([
           'name' => 'test',
           'origin' => 'Murcia',
           'vegan' => true,
           'gluten' => false,
           'category_id' => $this->category->id
       ]);
       Product::factory()->create([
           'name' => 'other',
           'origin' => 'Murcia',
           'vegan' => true,
           'gluten' => false,
           'category_id' => $this->category->id
       ]);
       Product::factory()->create([
           'name' => 'another',
           'origin' => 'Murcia',
           'vegan' => false,
           'gluten' => false,
           'category_id' => $categoryB->id
       ]);

       $request = new Request([
           'origin' => 'Murcia',
           'vegan' => false,
           'gluten' => false,
           'category_id' => $categoryB->id
       ]);


       $products = $this->controller->__invoke($request);

       $this->assertCount(1, $products);
   }

   #[Test] public function test_search_product_with_empty_field()
   {
       Product::factory()->create([
           'name' => 'test',
           'category_id' => $this->category->id
       ]);

       Product::factory()->create([
           'name' => 'other',
           'category_id' => $this->category->id
       ]);
       $requestEmpty = new Request([
           'name' => ''
       ]);

       $products = $this->controller->__invoke($requestEmpty);

       $this->assertCount(2, $products);
   }

   #[Test] public function test_search_product_without_field()
   {
       Product::factory()->create([
           'name' => 'test',
           'category_id' => $this->category->id
       ]);

       Product::factory()->create([
           'name' => 'other',
           'category_id' => $this->category->id
       ]);
       $requestEmpty = new Request([]);

       $products = $this->controller->__invoke($requestEmpty);

       $this->assertCount(2, $products);
   }
}
