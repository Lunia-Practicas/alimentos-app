<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateDescriptionOpenAIController;
use App\Http\Controllers\SaveDescriptionOpenAIController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SaveDescriptionOpenAITest extends TestCase
{
    use RefreshDatabase;
    private GenerateDescriptionOpenAIController $controllerA;
    private SaveDescriptionOpenAIController $controllerB;

    private Category $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->controllerA = $this->app->make(GenerateDescriptionOpenAIController::class);
        $this->controllerB = $this->app->make(SaveDescriptionOpenAIController::class);
        $this->category = Category::factory()->create();
        $this->category->fresh();
    }

    #[Test] public function test_create_description_openAI()
    {
        $productA = Product::factory()->create(['category_id' => $this->category->id]);
        $productB = Product::factory()->create(['category_id' => $this->category->id]);

        $response = $this->controllerA->__invoke($productA->id);

        $request = new Request([
            'description' => $response->description,
        ]);

        $this->controllerB->__invoke($request);

        $this->assertDatabaseHas('descriptions', [
            'description' => $response,
        ]);

    }
}
