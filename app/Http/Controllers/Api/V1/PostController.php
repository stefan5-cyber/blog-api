<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Api\V1\UpdatePostRequest;
use App\Http\Requests\Api\V1\StorePostRequest;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Resources\Api\V1\PostResource;
use App\Http\Controllers\Api\ApiController;
use App\Http\Filters\V1\PostFilter;
use App\Policies\V1\PostPolicy;
use App\Models\Post;


class PostController extends ApiController implements HasMiddleware
{

    protected $policyClass = PostPolicy::class;

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    public function index(PostFilter $filters)
    {

        return PostResource::collection(Post::filter($filters)->paginate());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $this->isAble('store', Post::class);

        return new PostResource(Post::create($request->mappedAttributes()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return new PostResource($post->load('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->isAble('update', $post);

        $post->update($request->mappedAttributes());

        return new PostResource($post->load('author'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->isAble('delete', $post);

        $post->delete();

        return $this->ok('');
    }
}
