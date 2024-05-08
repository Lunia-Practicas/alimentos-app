<?php

namespace Tests\Feature;

use App\Http\Controllers\UpdateProductController;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateProductTest extends TestCase
{
   use RefreshDatabase;
   private Request $request;
   private Product $product;
   private Category $category;
   private UpdateProductController $controller;

   protected function setUp(): void
   {
       parent::setUp();
       $this->category = Category::factory()->create();
       $this->category->fresh();
       $this->product = Product::factory()->create([
           'name' => 'test',
           'category_id' => $this->category->id
       ]);
       $this->product->fresh();
       $this->request = new Request([
           'name' => 'nuevo',
           'category_id' => $this->category->id,
           'weight' => 23,
           'origin' => 'Murcia',
           'price' => 20.00,
           'vegan' => false,
           'gluten' => false,
       ]);

       $this->controller = $this->app->make(UpdateProductController::class);
   }

   #[Test] public function test_update_product()
   {
       $user = User::factory()->create();
       $this->actingAs($user);
       $response = $this->controller->__invoke($this->product->id, $this->request);
       $responseArray = json_decode($response, true);
       $this->assertEquals('nuevo', $responseArray['name']);
   }

   #[Test] public function test_update_product_db()
   {
       $user = User::factory()->create();
       $this->actingAs($user);

       $this->controller->__invoke($this->product->id, $this->request);

       $this->assertDatabaseHas('products', [
           'name' => 'nuevo'
       ]);

       $this->assertDatabaseMissing('products', [
           'name' => 'test'
       ]);
   }

   #[Test] public function test_can_not_update_product_not_loggin()
   {
       $exceptionThrown = false;
       try {
           $this->controller->__invoke($this->product->id, $this->request);
       } catch (\Exception $exception) {
           $exceptionThrown = true;
       }

       $this->assertTrue($exceptionThrown);
   }
}
