<?php

namespace Tests\Feature;

use App\Http\Controllers\DeleteCategoryController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class DeleteCategoryTest extends TestCase
{
    use RefreshDatabase;
    private DeleteCategoryController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(DeleteCategoryController::class);
    }

    #[Test] public function test_delete_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $category1->refresh();
        $category2->refresh();

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/' . $category1->id,
        ]);

        $request->setRouteResolver(function () use ($request, $category1) {
            return (new Route(
                'DELETE',
                'api/categories/{id}',
                []
            ))->bind($request);
        });

        $categories = $this->controller->__invoke($request);

        $categoriesData = json_decode($categories, true);

        foreach ($categoriesData as $category) {
            $this->assertNotEquals($category1->id, $category['id']);
        }

    }

    #[Test] public function test_delete_category_db()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $category1->refresh();
        $category2->refresh();

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/' . $category1->id,
        ]);

        $request->setRouteResolver(function () use ($request, $category1) {
            return (new Route(
                'DELETE',
                'api/categories/{id}',
                []
            ))->bind($request);
        });

        $this->controller->__invoke($request);

        $this->assertDatabaseMissing('categories', [
            'id' => $category1->id
        ]);
    }

    #[Test] public function test_can_not_delete_non_existent_category()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $category1->refresh();
        $category2->refresh();

        $request = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/' . $category1->id,
        ]);

        $request->setRouteResolver(function () use ($request, $category1) {
            return (new Route(
                'DELETE',
                'api/categories/{id}',
                []
            ))->bind($request);
        });

        $this->controller->__invoke($request);

        $exceptionThrown = false;
        try {
            $this->controller->__invoke($request);
        } catch (\Exception $e) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
    }

    #[Test] public function can_not_delete_category_with_products()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();
        $product1 = Product::factory()->create([
            'category_id' => $category1->id
        ]);

        $category1->refresh();
        $category2->refresh();
        $product1->refresh();

        $exceptionThrown = false;
        try {
            $request = new Request([],[],[],[],[],[
                'REQUEST_URI' => 'api/categories/' . $category1->id,
            ]);

            $request->setRouteResolver(function () use ($request, $category1) {
                return (new Route(
                    'DELETE',
                    'api/categories/{id}',
                    []
                ))->bind($request);
            });

            $this->controller->__invoke($request);
        } catch (\Exception $e) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
    }
}
