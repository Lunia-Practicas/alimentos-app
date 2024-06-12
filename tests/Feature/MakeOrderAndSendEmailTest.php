<?php

namespace Tests\Feature;

use App\Http\Controllers\MakeOrderAndSendEmailController;
use App\Mail\OrderNotifyEmailAdmin;
use App\Mail\OrderNotifyEmailClient;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MakeOrderAndSendEmailTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;

    private MakeOrderAndSendEmailController $makeOrderAndSendEmailController;

    protected function setUp(): void
    {
        parent::setUp();
        $this->makeOrderAndSendEmailController = $this->app->make(MakeOrderAndSendEmailController::class);
    }

    #[Test] public function test_make_order_and_send_email()
    {
        Mail::fake();


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
            'email' => 'jaimecaballero99@gmail.com',
            'name_client' => 'Jaime Caballero',
            'city' => 'Murcia',
            'address' => 'Calle Falsa 123'
        ]);

        $this->makeOrderAndSendEmailController->__invoke($request);

        $this->assertDatabaseHas('orders', [
            'product_id' => $product2->id,
        ]);

        Mail::assertSent(OrderNotifyEmailClient::class);
        Mail::assertSent(OrderNotifyEmailAdmin::class);
    }
}
