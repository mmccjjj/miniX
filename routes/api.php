<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('posts/own', [PostController::class, 'getMyPosts']);
Route::get('posts/user/{id}', [PostController::class, 'getByUserID']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/user-info', [PostController::class, 'index']); // Um einen neuen Benutzer zu speichern
Route::post('/user-info', [PostController::class, 'store']);


// TODO: remove this on public release, only for testing!
Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});
