<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\CategoryRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;

readonly class SearchOrdersService
{

    public function __construct(private OrderRepository $orderRepository, private ProductRepository $productRepository, private CategoryRepository $categoryRepository)
    {
    }

    public function handle(SearchOrdersRequest $param)
    {
        $data = [
            'order_num' => $param->order_num,
            'email' => $param->email,
            'product_name' => $param->product_name,
            'category_id' => $param->category_id,
            'note' => $param->note,
            'quantity' => $param->quantity,
            'min_date' => $param->min_date,
            'max_date' => $param->max_date,
        ];

        $resultOrder = [];

        $orders = $this->orderRepository->searchOrders($data);

        foreach ($orders as $order) {
            $product = $this->productRepository->getProductById($order->product_id);
            $category = $this->categoryRepository->getCategoryById($order->category_id);
            $resultOrder[] = [
                'order_num' => $order->order_num,
                'email' => $order->email,
                'product_name' => $product->name,
                'category_name' => $category->name,
                'note' => $order->note,
                'quantity' => $order->quantity,
                'create_date' => $order->created_at
            ];
        }

        return $resultOrder;
    }
}