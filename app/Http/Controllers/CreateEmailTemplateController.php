<?php

namespace App\Http\Controllers;

use App\Services\CreateEmailTemplateService;
use App\Services\CreateEmailTemplateRequest;
use Illuminate\Http\Request;

class CreateEmailTemplateController extends Controller
{
    public function __construct(private readonly CreateEmailTemplateService $createEmailTemplateService)
    {
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);

        return $this->createEmailTemplateService->handle(new CreateEmailTemplateRequest(
            $request->input('title'),
            $request->input('subject'),
            $request->input('body'),
        ));
    }
}
