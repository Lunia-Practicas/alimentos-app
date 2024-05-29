<?php

namespace Tests\Feature;

use App\Http\Controllers\MakeOrdenAndSendEmailController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MakeOrdenAndSendEmailTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;

    private MakeOrdenAndSendEmailController $makeOrdenAndSendEmailController;

    protected function setUp(): void
    {
        parent::setUp();
        $this->makeOrdenAndSendEmailController = $this->app->make(MakeOrdenAndSendEmailController::class);
    }

    #[Test] public function test_make_orden_and_send_email()
    {

        $category = Category::factory()->create([
            'name' => 'Fruta'
        ]);
        $product = Product::factory()->create([
            'category_id' => $category->id
        ]);
        $product2 = Product::factory()->create([
            'category_id' => $category->id
        ]);

        $request = new Request([
            'id' => $product2->id,
            'quantity' => 1,
            'price' => $product->price,
            'email' => 'jaimecaballero99@gmail.com'
        ]);
        $orden = $this->makeOrdenAndSendEmailController->__invoke($request);

        $this->assertDatabaseHas('ordens', [
            'name' => $product2->name,
        ]);
    }
}
