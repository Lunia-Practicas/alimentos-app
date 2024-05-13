<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateDescriptionOpenAIController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GenerateDescriptionOpenAITest extends TestCase
{
    use RefreshDatabase;
    private GenerateDescriptionOpenAIController $controller;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GenerateDescriptionOpenAIController::class);
        $this->category = Category::factory()->create();
        $this->category->fresh();
    }

    #[Test] public function test_get_from_openai()
    {
        $productA = Product::factory()->create(['category_id' => $this->category->id]);
        Product::factory()->create(['category_id' => $this->category->id]);

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/description/' . $productA->id,
        ]);

        $request->setRouteResolver(function () use ($request, $productA) {
            return (new Route(
                'GET',
                'api/description/{id}',
                []
            ))->bind($request);
        });

        $response = $this->controller->__invoke($request);

        $this->assertArrayHasKey('description', $response);
        $this->assertNotNull( $response['description']);

    }
}
