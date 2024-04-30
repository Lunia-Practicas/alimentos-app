<?php

namespace Tests\Feature;

use App\Http\Controllers\DeleteCategoryController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;
    private DeleteCategoryController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(DeleteCategoryController::class);
    }

    #[Test] public function test_delete_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $category1->refresh();
        $category2->refresh();

        $categories = $this->controller->__invoke($category1->id);

        $categoriesData = json_decode($categories, true);

        foreach ($categoriesData as $category) {
            $this->assertNotEquals($category1->id, $category['id']);
        }

    }

    #[Test] public function test_delete_category_db()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $category1->refresh();
        $category2->refresh();

        $this->controller->__invoke($category1->id);

        $this->assertDatabaseMissing('categories', [
            'id' => $category1->id
        ]);
    }

    #[Test] public function test_can_not_delete_non_existent_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $category1->refresh();
        $category2->refresh();

        $this->controller->__invoke($category1->id);

        $exceptionThrown = false;
        try {
            $this->controller->__invoke('sdsds');
        } catch (\Exception $e) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
    }

    #[Test] public function can_not_delete_category_with_products()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        $product1 = Product::factory()->create([
            'category_id' => $category1->id
        ]);

        $category1->refresh();
        $category2->refresh();
        $product1->refresh();

        $exceptionThrown = false;
        try {
            $this->controller->__invoke($category1->id);
        } catch (\Exception $e) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
    }
}
