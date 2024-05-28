<?php

namespace Tests\Feature;

use App\Http\Controllers\SearchProductsNameImagePriceController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SearchProductsNameImageTest extends TestCase
{
   use RefreshDatabase;
   private Request $request;
   private SearchProductsNameImagePriceController $searchProductsNameImagePriceController;

   protected function setUp(): void
   {
       parent::setUp();
       $this->searchProductsNameImagePriceController = $this->app->make(SearchProductsNameImagePriceController::class);
   }

   #[Test] public function testSearchProductsNameImagePrice()
   {
       $category = Category::factory()->create([
           'name' => 'Fruta'
       ]);

       $productA = Product::factory()->create([
           'category_id' => $category->id,
           'price' => 20,
           'weight' => 10,
       ]);

       $productB = Product::factory()->create([
           'category_id' => $category->id,
           'price' => 10,
           'weight' => 20,
       ]);

       $productC = Product::factory()->create([
           'category_id' => $category->id,
           'price' => 20,
           'weight' => 20,
       ]);

       $request = new Request([
           'id' => $productA->id,
           'limit' => 2,
           'offset' => 6,
           'maxPrice' => 10,
           'minPrice' => 10,
           'minWeight' => 20,
           'maxWeight' => 10,
       ]);
   }
}
