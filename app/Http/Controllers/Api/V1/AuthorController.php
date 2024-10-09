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
     * Get all authors
     * 
     * @group Author
     * 
     * @queryParam sort string Data field(s). Example: sort=title,-status
     * @queryParam filter[id]. Filter by id. No-example
     * @queryParam filter[name] Filter by name. Wildcard supported. Example: name=*fix*
     * @queryParam filter[email] Filter by email. No-example
     * @queryParam filter[createdAt] Filter by created_at. No-example
     * @queryParam filter[updatedAt] Filter by updated_at. No-example
     * @queryParam include related posts. Example: include=posts
     *  
     */
    public function index(AuthorFilter $filters)
    {
        return UserResource::collection(User::where('role', 'author')->filter($filters)->paginate());
    }

    /**
     * Get author details by id
     * 
     * Retrieve author by id with posts included
     * 
     * @group Author
     *  
     */
    public function show(User $author)
    {
        return new UserResource($author->load('posts'));
    }

    /**
     * Update own profile information. Only for users with author:update permission
     * 
     * @authenticated
     * @group Author
     */
    public function update(UpdateUserRequest $request, User $author)
    {
        $this->isAble('updateOwnProfile', $author);

        $author->update($request->mappedAttributes());

        return new UserResource($author->load('posts'));
    }
}
