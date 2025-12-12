<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ---- Products ----
// Public
Route::apiResource('products',
    ProductController::class)
    ->only(['index', 'show']);
// Protected
Route::apiResource('products',
    ProductController::class)
    ->only(['store', 'update', 'destroy'])
    ->middleware('auth:sanctum');

// ---- Categories ----
// Public
Route::apiResource('categories',
    CategoryController::class)
    ->only(['index', 'show']);
// Protected
Route::apiResource('categories',
    CategoryController::class)
    ->only(['store', 'update', 'destroy'])
    ->middleware('auth:sanctum');
