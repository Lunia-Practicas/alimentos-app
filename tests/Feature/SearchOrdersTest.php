<?php

namespace Tests\Feature;

use App\Http\Controllers\SearchOrdersController;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SearchOrdersTest extends TestCase
{
    use RefreshDatabase;
    private Request $request;
    private Category $categoryA;
    private Category $categoryB;

    private SearchOrdersController $controller;

    protected function setUp():void
    {
        parent::setUp();
        $this->controller = $this->app->make(SearchOrdersController::class);
        $this->categoryA = Category::factory()->create([
            'name' => 'Fruta'
        ]);
        $this->categoryB = Category::factory()->create([
            'name' => 'Carne'
        ]);
    }

    #[Test] public function test_search_orders()
    {

        $productA = Product::factory()->create([
            'category_id' => $this->categoryA->id
        ]);

        $productB = Product::factory()->create([
            'category_id' => $this->categoryA->id
        ]);

        $fechaAntes = Carbon::create(2024,11,1);
        $fecha = Carbon::create(2024, 11, 2);
        $fechaDespues = Carbon::create(2024, 11, 3);

        $orderA = Order::factory()->create([
            'email' => 'primero@mail.com',
            'product_id' => $productA->id,
            'category_id' => $this->categoryA->id,
            'note' => 'Primer comentario',
            'quantity' => 3,
            'created_at' => $fecha
        ]);

        $orderB = Order::factory()->create([
            'email' => 'segundo@mail.com',
            'product_id' => $productB->id,
            'category_id' => $this->categoryA->id,
            'note' => 'Segundo comentario',
            'quantity' => 3,
            'created_at' => now()
        ]);

        $request = new Request([
            'order_num' => $orderA->order_num,
            'email' => $orderA->email,
            'product_name' => $productA->name,
            'category_id' => $this->categoryA->id,
            'note' => 'Primer comentario',
            'quantity' => 3,
            'min_date' => $fecha,
            'max_date' => $fechaDespues
        ]);

        $res = $this->controller->__invoke($request);

        $this->assertCount(1, $res);

        $request2 = new Request([
            'order_num' => $orderA->order_num,
            'email' => $orderA->email,
            'product_name' => $productA->name,
            'category_id' => $this->categoryA->id,
            'note' => 'Primer comentario',
            'quantity' => 3,
            'max_date' => $fechaAntes
        ]);

        $res2 = $this->controller->__invoke($request2);
        $this->assertCount(0, $res2);
    }
}
