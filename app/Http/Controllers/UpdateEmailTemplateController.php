<?php

namespace App\Http\Controllers;

use App\Services\UpdateEmailTemplateRequest;
use App\Services\UpdateEmailTemplateService;
use Illuminate\Http\Request;

class UpdateEmailTemplateController extends Controller
{
    public function __construct(private readonly UpdateEmailTemplateService  $updateEmailTemplateService)
    {
    }

    public function __invoke(Request $request)
    {
        $id = $request->route('id');

        $request->validate([
            'title' => 'required|unique:email_templates,title,' . $id,
            'subject' => 'required',
            'body' => 'required',
        ]);

        return $this->updateEmailTemplateService->handle(new UpdateEmailTemplateRequest(
            $request->route('id'),
            $request->input('title'),
            $request->input('subject'),
            $request->input('body'),
        ));
    }
}
