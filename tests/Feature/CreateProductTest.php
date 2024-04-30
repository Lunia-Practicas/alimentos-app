<?php

namespace Tests\Feature;

use App\Http\Controllers\CreateProductController;
use App\Models\Category;
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
        $this->request = new Request([
            'name' => 'Test Product',
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
        $category = Category::factory()->create();

        $this->controller->__invoke($this->request, $category->id);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'category_id' => $category->id,
        ]);
    }

    public function test_can_not_create_product_not_exists_category()
    {
        $exceptionThrown = false;
        try {
            $this->controller->__invoke($this->request, 1);
        } catch (\Exception $exception) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
    }

}
