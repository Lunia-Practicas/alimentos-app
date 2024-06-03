<?php

namespace App\Http\Controllers;

use App\Services\GenerateOrderPdfRequest;
use App\Services\GenerateOrderPdfService;
use Illuminate\Http\Request;

class GenerateOrderPdfController extends Controller
{

    public function __construct(private readonly GenerateOrderPdfService $generateOrderPdfService)
    {
    }

    public function __invoke(Request $request)
    {

        return $this->generateOrderPdfService->handle(new GenerateOrderPdfRequest(
            $request->input('order_num')
        ));
    }
}
