<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\AvatarImageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserReactionController;
use App\Http\Controllers\PostReactionController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', LogoutController::class);

    Route::apiResource('avatar-images', AvatarImageController::class);

    Route::get('notice-boards/{notice}', [NoticeBoardController::class, 'show']);

    Route::apiResource('posts', PostController::class);

    Route::apiResource('post-images', PostImageController::class);

    Route::apiResource('user-profiles', UserProfileController::class)
        ->only(['show', 'store', 'destroy']);

    Route::apiResource('user-reactions', UserReactionController::class);

    Route::get('posts/{postId}/reactions', [PostReactionController::class, 'index']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

