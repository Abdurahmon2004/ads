<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Form\AuthController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::get('/ads', [ApiController::class, 'ads']);
Route::get('/categories', [ApiController::class, 'categories']);
Route::get('/regions', [ApiController::class, 'regions']);

// Auth
Route::middleware('auth:sanctum')->group(function () {
    // user (CRUD)
    Route::post('/user/ads/create', [AdsController::class,'store']);
    Route::post('/user/ads/update/{id}', [AdsController::class,'update']);
    Route::delete('/user/ads/delete/{id}', [AdsController::class,'destroy']);
    // user (CRUD)
   
    // admin (CRUD)
    Route::middleware('admin')->group(function () {
        Route::apiResource('/admin/category', CategoryController::class);
        Route::post('/admin/category/update/{category}', [CategoryController::class, 'update']);

        Route::resource('/admin/region', RegionController::class);
        Route::post('/admin/region/update/{region}', [RegionController::class, 'update']);

        Route::resource('/admin/tag', TagController::class);
        Route::post('/admin/tag/update/{tag}', [TagController::class, 'update']);
    });
    // admin (CRUD)
});