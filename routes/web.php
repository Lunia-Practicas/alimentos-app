<?php

use App\Http\Controllers\ListAllCategoriesController;
use App\Http\Controllers\ListAllProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/categories', [ListAllCategoriesController::class, '__invoke'] );
