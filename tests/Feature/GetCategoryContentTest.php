<?php

namespace Tests\Feature;

use App\Http\Controllers\GetCategoryContentController;
use App\Models\Category;
use App\Models\CategoryContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetCategoryContentTest extends TestCase
{
    use RefreshDatabase;
    private GetCategoryContentController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GetCategoryContentController::class);
    }

    #[Test] public function test_get_category_content()
    {
        $category = Category::factory()->create([
            'name' => 'Fruta'
        ]);

        $categoryContent = CategoryContent::factory()->create([
            'category_id' => $category->id
        ]);

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/content/' . $categoryContent->category_id,
        ]);

        $request->setRouteResolver(function () use ($request, $categoryContent) {
            return (new Route(
                'GET',
                'api/categories/content/{id}',
                []
            ))->bind($request);
        });

        $response = $this->controller->__invoke($request);

        $this->assertEquals($categoryContent->category_id, $response['category_id']);
        $this->assertEquals('/storage/'.$categoryContent->image, $response['image']);

    }
}
