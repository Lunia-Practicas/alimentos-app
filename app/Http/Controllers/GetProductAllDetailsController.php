<?php

namespace App\Http\Controllers;

use App\Services\GetProductAllDetailsRequest;
use App\Services\GetProductAllDetailsService;
use Illuminate\Http\Request;

class GetProductAllDetailsController extends Controller
{
    public function __construct(private readonly GetProductAllDetailsService $getProductAllDetailsService)
    {

    }

    public function __invoke(Request $request)
    {
        return $this->getProductAllDetailsService->handle(new GetProductAllDetailsRequest(
            $request->route('id')
        ));
    }

}
