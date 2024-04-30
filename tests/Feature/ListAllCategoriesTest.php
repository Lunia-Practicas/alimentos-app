<?php

namespace Tests\Feature;

use App\Http\Controllers\ListAllCategoriesController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ListAllCategoriesTest extends TestCase
{
    use RefreshDatabase;
    private ListAllCategoriesController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(ListAllCategoriesController::class);
    }

    #[Test] public function test_list_all_categories()
    {
        Category::factory()->create();
        Category::factory()->create();

        $categories = $this->controller->__invoke();

        $categoriesData = json_decode($categories, true);

        foreach ($categoriesData as $category) {
            $this->assertArrayHasKey('name', $category);

            $this->assertNotEmpty($category['name']);
        }

    }
}
