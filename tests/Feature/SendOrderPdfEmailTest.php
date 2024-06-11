<?php

namespace Tests\Feature;

use App\Http\Controllers\SendOrderPdfEmailController;
use App\Models\Email;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SendOrderPdfEmailTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;
    private SendOrderPdfEmailController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(SendOrderPdfEmailController::class);
    }

    #[Test] public function testSendOrderPdfEmail()
    {
        $product = Product::factory()->create();
        $email = Email::factory()->create();
        Mail::fake();

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

        $this->assertDatabaseHas('audits', [
            'addressee' => $email->email,
            'subject' => 'Número pedido: ' . $orderA->order_num,
            'body' => 'order.pdf'
        ]);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
        $this->assertEquals('attachment; filename="order.pdf"', $response->headers->get('Content-Disposition'));
    }

    #[Test] public function testSendOrderPdfEmailFail()
    {
        $product = Product::factory()->create();
        $email = Email::factory()->create();
        Mail::fake();
        Mail::shouldReceive('send')
            ->once()
            ->andThrow(new \Exception('Mail sending failed'));

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

        $this->assertDatabaseHas('audits', [
            'addressee' => $email->email,
            'subject' => 'Número pedido: ' . $orderA->order_num,
            'body' => 'order.pdf',
            'error' => 'Mail sending failed'
        ]);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
        $this->assertEquals('attachment; filename="order.pdf"', $response->headers->get('Content-Disposition'));
    }
}
