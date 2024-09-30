<?php

use App\Http\Controllers\Api\V1\AuthorPostsController;
use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\PostController;
use Illuminate\Support\Facades\Route;


Route::apiResource('posts', PostController::class);
Route::apiResource('authors', AuthorController::class);
Route::apiResource('authors.posts', AuthorPostsController::class);
