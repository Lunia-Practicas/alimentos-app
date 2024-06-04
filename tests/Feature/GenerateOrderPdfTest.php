<?php

namespace Tests\Feature;

use App\Http\Controllers\GenerateOrderPdfController;
use App\Models\Order;
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
