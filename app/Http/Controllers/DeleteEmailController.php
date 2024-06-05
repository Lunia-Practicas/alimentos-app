<?php

namespace App\Http\Controllers;

use App\Services\DeleteEmailRequest;
use App\Services\DeleteEmailService;
use Illuminate\Http\Request;

class DeleteEmailController extends Controller
{

    public function __construct(private readonly DeleteEmailService $deleteEmailService)
    {
    }

    public function __invoke(Request $request)
    {
        $this->deleteEmailService->handle(new DeleteEmailRequest(
            $request->route('id')
        ));
    }
}
