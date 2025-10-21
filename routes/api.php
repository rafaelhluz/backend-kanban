<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::resource('users', App\Http\Controllers\UserController::class);
Route::prefix('v1')->group(function () {
    Route::resource('users', App\Http\Controllers\Api\UserController::class);
    Route::resource('tasks', App\Http\Controllers\Api\TaskController::class);
    Route::resource('positions', App\Http\Controllers\Api\PositionController::class);
    Route::resource('comments', App\Http\Controllers\Api\CommentController::class);
    Route::resource('attaches', App\Http\Controllers\Api\AttachController::class);
    Route::resource('boards', App\Http\Controllers\Api\BoardController::class);
    Route::resource('steps', App\Http\Controllers\Api\StepController::class);
});
