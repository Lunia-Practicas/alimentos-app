<?php

namespace App\Http\Controllers;

use App\Services\UpdateDescriptionOpenAIRequest;
use App\Services\UpdateDescriptionOpenAIService;
use Illuminate\Http\Request;

class UpdateDescriptionOpenAIController extends Controller
{
    public function __construct( private readonly UpdateDescriptionOpenAIService  $updateDescriptionOpenAIService)
    {

    }

    public function __invoke(Request $request)
    {
        return $this->updateDescriptionOpenAIService->handle(new UpdateDescriptionOpenAIRequest(
            $request->route('id'), $request->input('description')
        ));
    }
}
