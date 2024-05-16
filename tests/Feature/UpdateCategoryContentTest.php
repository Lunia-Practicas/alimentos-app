<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateCategoryDescriptionController;
use App\Http\Controllers\GenerateCategoryImageController;
use App\Http\Controllers\SaveCategoryDescriptionImageController;
use App\Http\Controllers\UpdateCategoryContentController;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Tests\TestCase;

class UpdateCategoryContentTest extends TestCase
{
   use RefreshDatabase;
   private GenerateCategoryDescriptionController $generateCategoryDescriptionController;
   private GenerateCategoryImageController $generateCategoryImageController;
   private SaveCategoryDescriptionImageController $saveCategoryDescriptionImageController;
   private UpdateCategoryContentController $updateCategoryContentController;

   protected function setUp():void
   {
       parent::setUp();
       $this->generateCategoryDescriptionController = $this->app->make(GenerateCategoryDescriptionController::class);
       $this->generateCategoryImageController = $this->app->make(GenerateCategoryImageController::class);
       $this->saveCategoryDescriptionImageController = $this->app->make(SaveCategoryDescriptionImageController::class);
       $this->updateCategoryContentController = $this->app->make(UpdateCategoryContentController::class);
   }

   public function test_update_category_content()
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

       $description = $this->generateCategoryDescriptionController->__invoke($request);

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

       $image = $this->generateCategoryImageController->__invoke($request1);

       //SAVE
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
           'image' => implode(",", $image),
           'description' => implode(",", $description),
       ]);

       //UPDATE
       $request3 = new Request([
           'image' => 'nueva_imagen',
           'description' => 'new_description',
       ],[],[],[],[],[
           'REQUEST_URI' => 'api/categories/content/' . $category->id,
       ]);

       $request3->setRouteResolver(function () use ($request3, $category) {
           return (new Route(
               'PATCH',
               'api/categories/content/{id}',
               []
           ))->bind($request3);
       });

       $this->updateCategoryContentController->__invoke($request3);

       $this->assertDatabaseHas('category_content', [
           'description' => 'new_description',
       ]);

       $this->assertDatabaseMissing('category_content', [
          'description' => implode(",", $description)
       ]);
   }
}
