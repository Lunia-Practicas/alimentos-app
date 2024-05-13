<?php

namespace App\Http\Controllers;

use App\Services\SaveDescriptionOpenAIRequest;
use App\Services\SaveDescriptionOpenAIService;
use Illuminate\Http\Request;


class SaveDescriptionOpenAIController extends Controller
{
    public function __construct(private readonly SaveDescriptionOpenAIService  $saveDescriptionOpenAIService)
    {

    }

    public function __invoke(Request $request)
    {
        return $this->saveDescriptionOpenAIService->handle(new SaveDescriptionOpenAIRequest(
            $request->route('id'),
            $request->input('description'),
            $request->input('title')
            )
        );
    }
}

