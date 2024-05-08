<?php

namespace Tests\Feature;

use App\Http\Controllers\CreateProductController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;
    private CreateProductController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $category = Category::factory()->create();
        $this->request = new Request([
            'name' => 'Test Product',
            'category_id' => $category->id,
            'weight' => 10,
            'origin' => 'Spain',
            'price' => 23,
            'vegan' => true,
            'gluten' => false
        ]);
        $this->controller = $this->app->make(CreateProductController::class);
    }

    #[Test] public function test_create_product_db()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->controller->__invoke($this->request);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',

        ]);
    }

    public function test_can_not_create_product_not_exists_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->request = new Request([
            'name' => 'Test Product',
            'category_id' => 3,
            'weight' => 10,
            'origin' => 'Spain',
            'price' => 23,
            'vegan' => true,
            'gluten' => false
        ]);
        $exceptionThrown = false;
        try {
            $this->controller->__invoke($this->request);
        } catch (\Exception $exception) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
    }

}
