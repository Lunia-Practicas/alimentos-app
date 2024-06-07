<?php

namespace App\Http\Controllers;

use App\Services\GenerateEmailRequest;
use App\Services\GenerateEmailService;
use Illuminate\Http\Request;

class GenerateEmailController extends Controller
{
    public function __construct(private GenerateEmailService $generateEmailService)
    {
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'subjectContent' => 'required',
            'htmlContent' => 'required',
        ]);

        return $this->generateEmailService->handle(new GenerateEmailRequest(
            $request->input('subjectContent'),
            $request->input('htmlContent')
        ));
    }
}
