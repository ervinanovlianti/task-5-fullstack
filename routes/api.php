<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth:api');


// Route::middleware('auth:api')->prefix('/v1')->group(function () {
//     Route::resource('/article', App\Http\Controllers\PostController::class)->only([
//         'index', 'store', 'show', 'update', 'destroy'
//     ]);
// });
Route::middleware('auth:api')->prefix('/v1')->group(function () {
    Route::resource('articles', App\Http\Controllers\ArticlesController::class);
});