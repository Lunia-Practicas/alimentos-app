<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateDescriptionOpenAIController;
use App\Http\Controllers\GenerateTitleController;
use App\Http\Controllers\SaveDescriptionOpenAIController;
use App\Http\Controllers\UpdateDescriptionOpenAIController;
use App\Models\Category;
use App\Models\Product;
use App\Services\UpdateDescriptionOpenAIService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateDescriptionTest extends TestCase
{
    use RefreshDatabase;
    private GenerateTitleController $controllerA;
    private GenerateDescriptionOpenAIController $controllerB;
    private SaveDescriptionOpenAIController $controllerC;
    private UpdateDescriptionOpenAIController $controllerD;

    private Category $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->controllerA = $this->app->make(GenerateTitleController::class);
        $this->controllerB = $this->app->make(GenerateDescriptionOpenAIController::class);
        $this->controllerC = $this->app->make(SaveDescriptionOpenAIController::class);
        $this->controllerD = $this->app->make(UpdateDescriptionOpenAIController::class);
        $this->category = Category::factory()->create();
        $this->category->fresh();
    }

    #[Test] public function test_update_description()
    {
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

        $this->assertDatabaseHas('descriptions', [
            'title' => implode(",", $title),
            'description' => implode(",", $description),
        ]);


        $request3 = new Request([
            'title' => 'new_title',
            'description' => 'new_description',
        ],[],[],[],[],[
            'REQUEST_URI' => 'api/description/' . $product->id,
        ]);

        $request3->setRouteResolver(function () use ($request3, $product) {
            return (new Route(
                'PATCH',
                'api/description/{id}',
                []
            ))->bind($request3);
        });

        $this->controllerD->__invoke($request3);

        $this->assertDatabaseHas('product_content', [
            'title' => 'new_title',
            'description' => 'new_description',
        ]);

        $this->assertDatabaseMissing('product_content', [
            'title' => implode(",", $title),
            'description' => implode(",", $description),
        ]);

    }
}
