<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Api\V1\UpdatePostRequest;
use App\Http\Requests\Api\V1\StorePostRequest;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Resources\Api\V1\PostResource;
use App\Http\Controllers\Api\ApiController;
use App\Http\Filters\V1\PostFilter;
use App\Models\Post;


class PostController extends ApiController implements HasMiddleware
{

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PostFilter $filters)
    {
        return PostResource::collection(Post::filter($filters)->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post->load('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
