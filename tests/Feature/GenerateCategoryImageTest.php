<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateCategoryImageController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GenerateCategoryImageTest extends TestCase
{
    use RefreshDatabase;
    private GenerateCategoryImageController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GenerateCategoryImageController::class);
    }

    #[Test] public function test_generate_category_image()
    {
        $category = Category::factory()->create([
            'name' => 'Fruta'
        ]);

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/image/' . $category->id,
        ]);

        $request->setRouteResolver(function () use ($request, $category) {
            return (new Route(
                'GET',
                'api/categories/image/{id}',
                []
            ))->bind($request);
        });

        $response = $this->controller->__invoke($request);
        $this->assertArrayHasKey('image', $response);
        $this->assertNotNull( $response['image']);
    }
}
