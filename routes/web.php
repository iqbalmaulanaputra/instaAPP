<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaveController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ExploreController;

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/post/{post}/save', [SaveController::class, 'toggle'])->name('posts.save');
    Route::post('/post/{post}/like', [LikeController::class, 'toggle'])->name('posts.like');
    Route::post('/post/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::post('/stories', [StoryController::class, 'store'])->name('stories.store');
    Route::post('/story/{story}/view', [StoryController::class, 'markViewed'])->name('stories.view');

    Route::post('/user/{user}/follow', [FollowController::class, 'toggle'])->name('users.follow');

    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.show');
});

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
