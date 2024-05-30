<?php

namespace App\Http\Controllers;

use App\Services\MakeOrderAndSendEmailRequest;
use App\Services\MakeOrderAndSendEmailService;
use Illuminate\Http\Request;

class MakeOrderAndSendEmailController extends Controller
{
    public function __construct(private readonly MakeOrderAndSendEmailService $makeOrdenAndSendEmailService)
    {
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'email' => 'required|email',
            'note' => 'nullable|string'
        ]);

        return $this->makeOrdenAndSendEmailService->handle(new MakeOrderAndSendEmailRequest(
            $request->input('id'),
            $request->input('quantity'),
            $request->input('price'),
            $request->input('email'),
            $request->input('note')
        ));
    }
}