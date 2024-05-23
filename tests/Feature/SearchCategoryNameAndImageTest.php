<?php

namespace Tests\Feature;

use App\Http\Controllers\SearchCategoryController;
use App\Models\Category;
use App\Models\CategoryContent;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SearchCategoryNameAndImageTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;

    private SearchCategoryController $controller;
    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(SearchCategoryController::class);
    }

    #[Test] public function test_search_category_name_and_image()
    {
        $categoryA = Category::factory()->create([
            'name' => 'Fruta'
        ]);

        $categoryB = Category::factory()->create([
            'name' => 'Carne'
        ]);

        CategoryContent::factory()->create([
            'category_id' => $categoryA->id,
        ]);

        CategoryContent::factory()->create([
            'category_id' => $categoryB->id,
        ]);

        $request = new Request([
            'name' => 'Fruta',
        ]);

        $categories = $this->controller->__invoke($request);

        $this->assertCount(1, $categories);

    }
}
