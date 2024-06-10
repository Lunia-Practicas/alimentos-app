<?php

namespace App\Http\Controllers;

use App\Services\DeleteEmailTemplateRequest;
use App\Services\DeleteEmailTemplateService;
use Illuminate\Http\Request;

class DeleteEmailTemplateController extends Controller
{
    public function __construct(private readonly DeleteEmailTemplateService $deleteEmailTemplateService)
    {
    }

    public function __invoke(Request $request)
    {
        $this->deleteEmailTemplateService->handle(new DeleteEmailTemplateRequest(
            $request->route('id')
        ));
    }
}
