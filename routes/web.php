<?php

use App\Http\Controllers\CreateCategoryController;
use App\Http\Controllers\CreateProductController;
use App\Http\Controllers\DeleteCategoryController;
use App\Http\Controllers\DeleteProductController;
use App\Http\Controllers\ListAllCategoriesController;
use App\Http\Controllers\ListAllProductsController;
use App\Http\Controllers\UpdateCategoryController;
use App\Http\Controllers\UpdateProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/categories', [ListAllCategoriesController::class, '__invoke'] );
Route::post('/categories', [CreateCategoryController::class, '__invoke'] );
Route::patch('/categories/{id}', [UpdateCategoryController::class, '__invoke'] );
Route::delete('/categories/{id}', [DeleteCategoryController::class, '__invoke'] );

Route::post('/products', [CreateProductController::class, '__invoke'] );
Route::get('/products', [ListAllProductsController::class, '__invoke'] );
Route::patch('/products/{id}', [UpdateProductController::class, '__invoke'] );
Route::delete('/products/{id}', [DeleteProductController::class, '__invoke'] );
