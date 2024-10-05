<?php

namespace App\Policies\V1;

use App\Permissions\V1\Abilities;
use App\Models\User;


class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function index(User $user)
    {
        if ($user->tokenCan(Abilities::IndexUser)) {
            return true;
        }

        return false;
    }

    public function store(User $user)
    {
        if ($user->tokenCan(Abilities::StoreUser)) {
            return true;
        }

        return false;
    }

    public function show(User $user)
    {
        if ($user->tokenCan(Abilities::ShowUser)) {
            return true;
        }

        return false;
    }

    public function update(User $user)
    {
        if ($user->tokenCan(Abilities::UpdateUser)) {
            return true;
        }

        return false;
    }

    public function delete(User $user)
    {
        if ($user->tokenCan(Abilities::DeleteUser)) {
            return true;
        }

        return false;
    }

    public function updateOwnProfile(User $user, User $author)
    {

        if ($user->tokenCan(Abilities::UpdateOwnProfile)) {
            return $user->id == $author->id;
        }

        if ($user->tokenCan(Abilities::UpdateUser)) {
            return true;
        }

        return false;
    }
}
