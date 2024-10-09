<?php

use App\Http\Controllers\Api\V1\AuthorPostsController;
use App\Http\Controllers\Api\V1\AuthorController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;


Route::apiResource('posts', PostController::class);
Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
Route::apiResource('authors', AuthorController::class)->except(['destroy', 'store']);
Route::apiResource('authors.posts', AuthorPostsController::class)->only('index');
