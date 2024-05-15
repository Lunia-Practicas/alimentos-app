<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateCategoryDescriptionController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GenerateCategoryDescriptionTest extends TestCase
{
    use RefreshDatabase;
    private GenerateCategoryDescriptionController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GenerateCategoryDescriptionController::class);

    }

    #[Test] public function test_generate_category_description()
    {
        $category = Category::factory()->create([
            'name' => 'Fruta'
        ]);

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/description/' . $category->id,
        ]);

        $request->setRouteResolver(function () use ($request, $category) {
            return (new Route(
                'GET',
                'api/categories/description/{id}',
                []
            ))->bind($request);
        });

        $response = $this->controller->__invoke($request);

        $this->assertArrayHasKey('description', $response);
        $this->assertNotNull( $response['description']);

    }
}
