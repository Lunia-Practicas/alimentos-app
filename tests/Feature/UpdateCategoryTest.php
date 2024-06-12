<?php

namespace Tests\Feature;

use App\Http\Controllers\UpdateCategoryController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateCategoryTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;
    private UpdateCategoryController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->request = new Request([
            'name' => 'actualizado'
        ]);
        $this->controller = $this->app->make(UpdateCategoryController::class);
    }

    #[Test] public function test_update_category()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create(['name' => 'test']);
        $category->refresh();

        $request = new Request([
            'name' => 'actualizado'
        ],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/' . $category->id,
        ]);

        $request->setRouteResolver(function () use ($request, $category) {
            return (new Route(
                'PATCH',
                'api/categories/{id}',
                []
            ))->bind($request);
        });

        $response = $this->controller->__invoke($request);
        $responseArray = json_decode($response, true);
        $this->assertEquals('actualizado', $responseArray['name']);
    }

    #[Test] public function test_update_category_db()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $category = Category::factory()->create(['name' => 'test']);
        $category->refresh();

        $request = new Request([
            'name' => 'actualizado'
        ],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/' . $category->id,
        ]);

        $request->setRouteResolver(function () use ($request, $category) {
            return (new Route(
                'PATCH',
                'api/categories/{id}',
                []
            ))->bind($request);
        });

        $this->controller->__invoke($request);

        $this->assertDatabaseHas('categories', [
            'name' => 'actualizado'
        ]);

        $this->assertDatabaseMissing('categories', [
            'name' => 'test'
        ]);

    }

    #[Test] public function test_can_not_update_not_loggin()
    {

        $category = Category::factory()->create(['name' => 'test']);
        $category->refresh();

        $request = new Request([
            'name' => 'actualizado'
        ],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/' . $category->id,
        ]);

        $request->setRouteResolver(function () use ($request, $category) {
            return (new Route(
                'PATCH',
                'api/categories/{id}',
                []
            ))->bind($request);
        });

        $exceptionThrown = false;
        try {
            $this->controller->__invoke($request);
        } catch (\Exception $exception) {
            $exceptionThrown = true;
        }

        $this->assertTrue($exceptionThrown);
    }
}
