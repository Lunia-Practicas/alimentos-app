<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateDescriptionOpenAIController;
use App\Http\Controllers\GenerateTitleController;
use App\Http\Controllers\SaveDescriptionOpenAIController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SaveDescriptionOpenAITest extends TestCase
{
    use RefreshDatabase;
    private GenerateTitleController $controllerA;
    private GenerateDescriptionOpenAIController $controllerB;
    private SaveDescriptionOpenAIController $controllerC;

    private Category $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->controllerA = $this->app->make(GenerateTitleController::class);
        $this->controllerB = $this->app->make(GenerateDescriptionOpenAIController::class);
        $this->controllerC = $this->app->make(SaveDescriptionOpenAIController::class);
        $this->category = Category::factory()->create();
        $this->category->fresh();
    }

    #[Test] public function test_create_description_openAI()
    {
        //Title
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

        $title = $this->controllerA->__invoke($request);

        //ProductContent
        $request1 = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/description/' . $product->id,
        ]);

        $request1->setRouteResolver(function () use ($request1, $product) {
            return (new Route(
                'GET',
                'api/description/{id}',
                []
            ))->bind($request1);
        });

        $description = $this->controllerB->__invoke($request1);

        //Save
        $request2 = new Request([
            'title' => implode(",", $title),
            'description' => implode(",", $description),
        ],[],[],[],[],[
            'REQUEST_URI' => 'api/description/' . $product->id,
        ]);

        $request2->setRouteResolver(function () use ($request2, $product) {
            return (new Route(
                'GET',
                'api/description/{id}',
                []
            ))->bind($request2);
        });

        $this->controllerC->__invoke($request2);

        $this->assertDatabaseHas('product_content', [
            'title' => implode(",", $title),
            'description' => implode(",", $description),
        ]);

    }
}
