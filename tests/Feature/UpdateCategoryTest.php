<?php

namespace Tests\Feature;

use App\Http\Controllers\UpdateCategoryController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;
    private UpdateCategoryController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new Request([
            'name' => 'actualizado'
        ]);
        $this->controller = $this->app->make(UpdateCategoryController::class);
    }

    #[Test] public function test_update_category()
    {
        $category = Category::factory()->create(['name' => 'test']);
        $category->refresh();

        $response = $this->controller->__invoke($category->id, $this->request);
        $responseArray = json_decode($response, true);
        $this->assertEquals('actualizado', $responseArray['name']);
    }

    #[Test] public function test_update_category_db()
    {
        $category = Category::factory()->create(['name' => 'test']);
        $category->refresh();

        $this->controller->__invoke($category->id, $this->request);

        $this->assertDatabaseHas('categories', [
            'name' => 'actualizado'
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => 'test'
        ]);

    }
}
