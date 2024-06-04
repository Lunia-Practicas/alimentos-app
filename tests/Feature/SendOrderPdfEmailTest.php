<?php

namespace Tests\Feature;

use App\Http\Controllers\SendOrderPdfEmailController;
use App\Models\Order;
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
        Mail::fake();

        $orderA = Order::factory()->create();
        Order::factory()->create();

        $request = new Request([
            'order_num' => $orderA->order_num,
        ]);

        $response = $this->controller->__invoke($request);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
        $this->assertEquals('attachment; filename="order.pdf"', $response->headers->get('Content-Disposition'));
    }
}
