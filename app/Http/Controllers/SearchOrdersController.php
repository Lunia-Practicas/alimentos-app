<?php

namespace App\Http\Controllers;

use App\Repositories\OrderRepository;
use App\Services\SearchOrdersRequest;
use App\Services\SearchOrdersService;
use Illuminate\Http\Request;

class SearchOrdersController extends Controller
{
    public function __construct(private readonly SearchOrdersService  $searchOrdersService)
    {
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'order_num' => 'nullable|integer',
            'email' => 'nullable|email',
            'product_name' => 'nullable|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'note' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'min_date' => 'nullable',
            'max_date' => 'nullable',
        ]);

        return $this->searchOrdersService->handle(new SearchOrdersRequest(
            $request->input('order_num'),
            $request->input('email'),
            $request->input('product_name'),
            $request->input('category_id'),
            $request->input('note'),
            $request->input('quantity'),
            $request->input('min_date'),
            $request->input('max_date'),
        ));


    }
}
