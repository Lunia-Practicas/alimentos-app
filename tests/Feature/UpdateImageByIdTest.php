<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateImageDescriptionController;
use App\Http\Controllers\UpdateImageByIdController;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductContent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateImageByIdTest extends TestCase
{
    use RefreshDatabase;
    private GenerateImageDescriptionController $controllerGenerate;
    private UpdateImageByIdController $controllerUpdate;
    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controllerGenerate = $this->app->make(GenerateImageDescriptionController::class);
        $this->controllerUpdate = $this->app->make(UpdateImageByIdController::class);

        $this->category = Category::factory()->create();
        $this->category->fresh();
    }

    #[Test] public function test_update_image()
    {
        $product = Product::factory()->create(['category_id' => $this->category->id]);
        ProductContent::factory()->create(['product_id' => $product->id]);
        $image = Image::factory()->create(['product_id' => $product->id]);

        $request = new Request([
            'image' => 'nueva'
        ],[],[],[],[],[
            'REQUEST_URI' => 'api/products/image/' . $image->id,
        ]);

        $request->setRouteResolver(function () use ($request, $image) {
            return (new Route(
                'PATCH',
                'api/products/image/{id}',
                []
            ))->bind($request);
        });

        $response = $this->controllerUpdate->__invoke($request);

        $this->assertInstanceOf(Image::class, $response);

    }
}
