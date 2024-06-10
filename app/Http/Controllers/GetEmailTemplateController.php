<?php

namespace App\Http\Controllers;

use App\Services\GetEmailTemplateRequest;
use App\Services\GetEmailTemplateService;
use Illuminate\Http\Request;

class GetEmailTemplateController extends Controller
{
    public function __construct(private readonly GetEmailTemplateService $getEmailTemplateService)
    {
    }

    public function __invoke(Request $request)
    {
        return $this->getEmailTemplateService->handle(new GetEmailTemplateRequest(
            $request->route('id')
        ));
    }
}
