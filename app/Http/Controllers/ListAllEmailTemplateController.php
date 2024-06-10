<?php

namespace App\Http\Controllers;

use App\Services\GetAllEmailTemplateRequest;
use App\Services\GetAllEmailTemplateService;
use Illuminate\Http\Request;

class ListAllEmailTemplateController extends Controller
{
    public function __construct(private readonly GetAllEmailTemplateService $getAllEmailTemplateService)
    {
    }

    public function __invoke()
    {
        return $this->getAllEmailTemplateService->handle(new GetAllEmailTemplateRequest());
    }
}
