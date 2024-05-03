<?php

use App\Http\Controllers\CreateCategoryController;
use App\Http\Controllers\CreateProductController;
use App\Http\Controllers\DeleteCategoryController;
use App\Http\Controllers\DeleteProductController;
use App\Http\Controllers\GetCategoryByIdController;
use App\Http\Controllers\GetProductByIdController;
use App\Http\Controllers\ListAllCategoriesController;
use App\Http\Controllers\ListAllProductsByCategoryIdController;
use App\Http\Controllers\ListAllProductsController;
use App\Http\Controllers\SearchProductController;
use App\Http\Controllers\UpdateCategoryController;
use App\Http\Controllers\UpdateProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/categories', [CreateCategoryController::class, '__invoke'] );
Route::get('/categories', [ListAllCategoriesController::class, '__invoke'] );
Route::get('/categories/{id}', [GetCategoryByIdController::class, '__invoke'] );
Route::patch('/categories/{id}', [UpdateCategoryController::class, '__invoke'] );
Route::delete('/categories/{id}', [DeleteCategoryController::class, '__invoke'] );

Route::get('/categories/products/{id}', [ListAllProductsByCategoryIdController::class, '__invoke'] );

Route::post('/products', [CreateProductController::class, '__invoke'] );
Route::get('/products', [ListAllProductsController::class, '__invoke'] );
Route::post('/products', [SearchProductController::class, '__invoke'] );
Route::get('/products/{id}', [GetProductByIdController::class, '__invoke'] );
Route::patch('/products/{id}', [UpdateProductController::class, '__invoke'] );
Route::delete('/products/{id}', [DeleteProductController::class, '__invoke'] );
