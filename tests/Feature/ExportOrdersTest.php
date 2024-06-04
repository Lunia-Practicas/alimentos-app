<?php

namespace Tests\Feature;

use App\Http\Controllers\ExportOrdersController;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExportOrdersTest extends TestCase
{
    use RefreshDatabase;

    private Request $request;

    private ExportOrdersController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = $this->app->make(ExportOrdersController::class);
    }

    #[Test] public function testExportOrders()
    {
        Order::factory()->create();
        Order::factory()->create();

        Excel::fake();

        $request = new Request();

        $this->controller->__invoke($request);

        Excel::assertDownloaded('orders.xlsx');

    }
}
