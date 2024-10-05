<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\UpdateUserRequest;
use App\Http\Requests\Api\V1\StoreUserRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Http\Controllers\Api\ApiController;
use App\Http\Filters\V1\UserFilter;
use App\Policies\V1\UserPolicy;
use App\Models\User;


class UserController extends ApiController
{

    protected $policyClass = UserPolicy::class;

    /**
     * Display a listing of the resource.
     */
    public function index(UserFilter $filters)
    {

        $this->isAble('index', User::class);

        return UserResource::collection(User::filter($filters)->paginate());
    }

    /**
     * Store the specified resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->isAble('store', User::class);

        return new UserResource(User::create($request->mappedAttributes()));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->isAble('show', $user);

        return new UserResource($user->load('posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->isAble('update', $user);

        $user->update($request->mappedAttributes());

        return new UserResource($user->load('posts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function destroy(User $user)
    {
        $this->isAble('delete', $user);

        $user->delete();

        return $this->ok('');
    }
}
