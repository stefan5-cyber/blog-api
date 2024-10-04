<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\Api\V1\UpdateUserRequest;
use Illuminate\Routing\Controllers\Middleware;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Controllers\Api\ApiController;
use App\Http\Filters\V1\AuthorFilter;
use App\Policies\V1\UserPolicy;
use App\Models\User;


class AuthorController extends ApiController implements HasMiddleware
{

    protected $policyClass = UserPolicy::class;

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
    public function index(AuthorFilter $filters)
    {
        return UserResource::collection(User::where('role', 'author')->filter($filters)->paginate());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $author)
    {
        return new UserResource($author->load('posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $author)
    {
        $this->isAble('updateOwnProfile', $author);

        $author->update($request->mappedAttributes());

        return new UserResource($author->load('posts'));
    }
}
