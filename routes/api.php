<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ThemaController;

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{id}', [PostController::class, 'show']);

Route::get('/themas', [ThemaController::class, 'index']);
Route::post('/themas', [ThemaController::class, 'store']);
Route::get('/themas/{id}', [ThemaController::class, 'show']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user-info', [PostController::class, 'index']); // Um einen neuen Benutzer zu speichern
Route::post('/user-info', [PostController::class, 'store']);


// TODO: remove this on public release, only for testing!
Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});
