<?php

use App\Http\Controllers\CreateCategoryController;
use App\Http\Controllers\CreateProductController;
use App\Http\Controllers\DeleteCategoryController;
use App\Http\Controllers\DeleteProductController;
use App\Http\Controllers\GenerateDescriptionOpenAIController;
use App\Http\Controllers\GenerateTitleController;
use App\Http\Controllers\GetCategoryByIdController;
use App\Http\Controllers\GetDescriptionOpenAIController;
use App\Http\Controllers\GetProductByIdController;
use App\Http\Controllers\ListAllCategoriesController;
use App\Http\Controllers\ListAllProductsByCategoryIdController;
use App\Http\Controllers\ListAllProductsController;
use App\Http\Controllers\SaveDescriptionOpenAIController;
use App\Http\Controllers\SearchProductController;
use App\Http\Controllers\UpdateCategoryController;
use App\Http\Controllers\UpdateDescriptionOpenAIController;
use App\Http\Controllers\UpdateProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth');

Route::post('/categories', [CreateCategoryController::class, '__invoke'] )->middleware('auth');
Route::get('/categories', [ListAllCategoriesController::class, '__invoke'] )->middleware('auth');
Route::get('/categories/{id}', [GetCategoryByIdController::class, '__invoke'] )->middleware('auth');
Route::patch('/categories/{id}', [UpdateCategoryController::class, '__invoke'] )->middleware('auth');
Route::delete('/categories/{id}', [DeleteCategoryController::class, '__invoke'] )->middleware('auth');

Route::get('/categories/products/{id}', [ListAllProductsByCategoryIdController::class, '__invoke'] )->middleware('auth');

Route::post('/products', [CreateProductController::class, '__invoke'] )->middleware('auth');
Route::get('/products', [ListAllProductsController::class, '__invoke'] )->middleware('auth');
Route::post('/products/search', [SearchProductController::class, '__invoke'] )->middleware('auth');
Route::get('/products/{id}', [GetProductByIdController::class, '__invoke'] )->middleware('auth');
Route::patch('/products/{id}', [UpdateProductController::class, '__invoke'] )->middleware('auth');
Route::delete('/products/{id}', [DeleteProductController::class, '__invoke'] )->middleware('auth');

Route::get('/products/description/{id}',[GenerateDescriptionOpenAIController::class, '__invoke'])->middleware('auth');
Route::get('/products/description-title/{id}',[GenerateTitleController::class, '__invoke'])->middleware('auth');
Route::post('/products/description/{id}',[SaveDescriptionOpenAIController::class, '__invoke'])->middleware('auth');
Route::patch('/products/description/{id}', [UpdateDescriptionOpenAIController::class, '__invoke'])->middleware('auth');
Route::get('/products/description/info/{id}', [GetDescriptionOpenAIController::class, '__invoke'])->middleware('auth');
