<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateOrderPdfController;
use App\Models\Email;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GenerateOrderPdfTest extends TestCase
{
    use RefreshDatabase;

    private Request $request;

    private GenerateOrderPdfController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(GenerateOrderPdfController::class);
    }

    #[Test] public function testGenerateOrderPdf()
    {
        $product = Product::factory()->create();
        $email = Email::factory()->create();

        $orderA = Order::factory()->create([
            'email' => $email->email,
            'product_id' => $product->id,
            'category_id' => $product->category_id,
            'quantity' => 1
        ]);

        $request = new Request([
            'order_num' => $orderA->order_num,
        ]);

        $response = $this->controller->__invoke($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
        $this->assertEquals('attachment; filename="order.pdf"', $response->headers->get('Content-Disposition'));
    }
}
