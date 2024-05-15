<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateCategoryDescriptionController;
use App\Http\Controllers\GenerateCategoryImageController;
use App\Http\Controllers\SaveCategoryDescriptionImageController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SaveCategoryDescriptionImageTest extends TestCase
{
    use RefreshDatabase;
    private GenerateCategoryDescriptionController $categoryDescriptionController;
    private GenerateCategoryImageController $categoryImageController;
    private SaveCategoryDescriptionImageController $saveCategoryDescriptionImageController;

    protected  function setUp(): void
    {
        parent::setUp();
        $this->categoryDescriptionController = $this->app->make(GenerateCategoryDescriptionController::class);
        $this->categoryImageController = $this->app->make(GenerateCategoryImageController::class);
        $this->saveCategoryDescriptionImageController = $this->app->make(SaveCategoryDescriptionImageController::class);
    }

    #[Test] public function test_save_category_description_image()
    {
        $category = Category::factory()->create([
            'name' => 'Fruta'
        ]);

        //DESCRIPTION
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

        $description = $this->categoryDescriptionController->__invoke($request);

        //IMAGE
        $request1 = new Request([],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/image/' . $category->id,
        ]);

        $request1->setRouteResolver(function () use ($request1, $category) {
            return (new Route(
                'GET',
                'api/categories/image/{id}',
                []
            ))->bind($request1);
        });

        $image = $this->categoryImageController->__invoke($request1);

        // SAVE
        $request2 = new Request([
            'description' => implode(",", $description),
            'image' => implode(",", $image)
        ],[],[],[],[],[
            'REQUEST_URI' => 'api/categories/image/' . $category->id,
        ]);
        $request2->setRouteResolver(function () use ($request2, $category) {
            return (new Route(
                'POST',
                'api/categories/image/{id}',
                []
            ))->bind($request2);
        });

        $this->saveCategoryDescriptionImageController->__invoke($request2);

        $this->assertDatabaseHas('category_content', [
            'description' => implode(",", $description),
            'image' => implode(",", $image)
        ]);
    }

}
