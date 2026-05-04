<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

use App\Http\Controllers\CategoryController;

use App\Http\Controllers\JobListingController;

use App\Http\Controllers\ApplicationController;

use App\Http\Controllers\Admin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts/{post}', [PostController::class, 'show'])->middleware('ensure.post.is.published')->name('posts.show');


// Public routes

Route::get('/', fn() => redirect()->route('posts.index'));

Route::resource('posts', PostController::class)->only(['index', 'show']);

Route::resource('jobs', JobListingController::class)->only(['index', 'show']);

Route::resource('jobs.applications', ApplicationController::class)->only(['create', 'store']);

Route::resource('categories', CategoryController::class)->only(['index', 'show']);

// Authenticated routes

Route::middleware('auth')->group(function () {

    Route::resource('posts', PostController::class)->except(['index', 'show']);

    //Route::resource('categories', CategoryController::class);

});

// Admin routes


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', Admin\DashboardController::class)->name('dashboard');

    Route::resource('posts', Admin\PostController::class);

});


