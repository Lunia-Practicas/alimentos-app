<?php

namespace App\Http\Controllers;

use App\Services\SearchEmailsRequest;
use App\Services\SearchEmailsService;
use Illuminate\Http\Request;

class SearchEmailsController extends Controller
{
    public function __construct(private readonly SearchEmailsService $searchEmailsService)
    {
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'id' => 'nullable|integer',
            'email' => 'nullable|email',
            'name_client' => 'nullable|string',
            'city' => 'nullable|string',
            'address' => 'nullable|string',
            'min_date' => 'nullable',
            'max_date' => 'nullable',
        ]);

        return $this->searchEmailsService->handle(new SearchEmailsRequest(
            $request->input('id'),
            $request->input('email'),
            $request->input('name_client'),
            $request->input('city'),
            $request->input('address'),
            $request->input('min_date'),
            $request->input('max_date')
        ));
    }
}
