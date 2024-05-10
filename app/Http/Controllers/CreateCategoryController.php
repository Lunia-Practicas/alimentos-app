<?php

namespace App\Http\Controllers;

use App\Services\CreateCategoryRequest;
use App\Services\CreateCategoryService;
use Illuminate\Http\Request;
use PHPUnit\Framework\Exception;
use function PHPUnit\Framework\throwException;

class CreateCategoryController extends Controller
{
    public function __construct(private readonly CreateCategoryService $createCategoryService)
    {

    }

    public function __invoke(Request $request)
    {
       $request->validate([
           'name' => 'required|unique:categories',
       ]);

        if (!auth()->check()) {
            throw new \RuntimeException('Usuario no autenticado.', 401);
        }

        $id = auth()->user()->getAuthIdentifier();

       //dump($id);

       $category = $this->createCategoryService->handle(new CreateCategoryRequest(
           $request->input('name'),$id
       ));

       $category->fresh();

       return $category->toJson();
    }
}
