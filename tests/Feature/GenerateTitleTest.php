<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateTitleController;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GenerateTitleTest extends TestCase
{

    use RefreshDatabase;
    private GenerateTitleController $controller;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GenerateTitleController::class);
        $this->category = Category::factory()->create();
        $this->category->fresh();
    }

    #[Test] public function test_generate_title()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $product = Product::factory()->create(['category_id' => $this->category->id]);

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/products/description-title/' . $product->id,
        ]);

        $request->setRouteResolver(function () use ($request, $product) {
            return (new Route(
                'GET',
                'api/products/description-title/{id}',
                []
            ))->bind($request);
        });

        $response = $this->controller->__invoke($request);

        $this->assertArrayHasKey('title', $response);
        $this->assertNotNull( $response['title']);
    }
}
