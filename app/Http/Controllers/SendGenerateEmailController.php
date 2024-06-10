<?php

namespace App\Http\Controllers;

use App\Services\SendGenerateEmailRequest;
use App\Services\SendGenerateEmailService;
use Illuminate\Http\Request;

class SendGenerateEmailController extends Controller
{
    public function __construct(private SendGenerateEmailService  $sendGenerateEmailService)
    {
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'subjectContent' => 'required',
            'htmlContent' => 'required',
        ]);

        return $this->sendGenerateEmailService->handle(new SendGenerateEmailRequest(
            $request->input('subjectContent'),
            $request->input('htmlContent')
        ));
    }
}
