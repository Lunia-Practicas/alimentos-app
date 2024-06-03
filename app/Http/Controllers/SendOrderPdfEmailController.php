<?php

namespace App\Http\Controllers;

use App\Services\SendOrderPdfEmailRequest;
use App\Services\SendOrderPdfEmailService;
use Illuminate\Http\Request;

class SendOrderPdfEmailController extends Controller
{
    public function __construct(private readonly SendOrderPdfEmailService $sendOrderPdfEmailService)
    {
    }

    public function __invoke(Request $request)
    {
        return $this->sendOrderPdfEmailService->handle(new SendOrderPdfEmailRequest(
            $request->input('order_num')
        ));
    }
}
