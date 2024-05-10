<?php

namespace App\Http\Controllers;

use App\Services\GetDescriptionOpenAIRequest;
use App\Services\GetDescriptionOpenAIService;
use Illuminate\Http\Request;

class GetDescriptionOpenAIController extends Controller
{
    public function __construct(private readonly GetDescriptionOpenAIService $getDescriptionOpenAIService)
    {

    }

    public function __invoke(Request $request)
    {
        return $this->getDescriptionOpenAIService->handle(new GetDescriptionOpenAIRequest(
            $request->route('id')
        ));
    }
}
