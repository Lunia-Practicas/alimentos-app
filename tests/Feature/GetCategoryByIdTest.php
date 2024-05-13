<?php

namespace Tests\Feature;

use App\Http\Controllers\GetCategoryByIdController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Tests\TestCase;

class GetCategoryByIdTest extends TestCase
{

    use RefreshDatabase;
    private GetCategoryByIdController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GetCategoryByIdController::class);
    }

    public function test_get_category_by_id()
    {
        $categoryA = Category::factory()->create();
        $categoryB = Category::factory()->create();

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/' . $categoryA->id,
        ]);

        $request->setRouteResolver(function () use ($request, $categoryA) {
            return (new Route(
                'GET',
                'api/categories/{id}',
                []
            ))->bind($request);
        });

        $category = $this->controller->__invoke($request);
        $categoriesData = json_decode($category, true);

        $this->assertEquals($categoryA->id, $categoriesData['id']);
        $this->assertEquals($categoryA->name, $categoriesData['name']);

        $this->assertNotEquals($categoryB->id, $categoriesData['id']);
        $this->assertNotEquals($categoryB->name, $categoriesData['name']);

    }
}
