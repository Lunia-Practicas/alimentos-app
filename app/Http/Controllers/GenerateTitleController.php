<?php

namespace App\Http\Controllers;

use App\Services\GenerateTitleRequest;
use App\Services\GenerateTitleService;
use Illuminate\Http\Request;

class GenerateTitleController extends Controller
{
    public function __construct(private readonly GenerateTitleService $generateTitleService)
    {

    }

    public function __invoke(Request $request): array
    {
        return $this->generateTitleService->handle(new GenerateTitleRequest(
            $request->route('id')));
    }
}
