<?php

namespace App\Policies\V1;

use App\Permissions\V1\Abilities;
use App\Models\Post;
use App\Models\User;


class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function store(User $user)
    {

        if ($user->tokenCan(Abilities::StorePost)) {
            return true;
        }

        return false;
    }

    public function update(User $user, Post $post)
    {

        if ($user->tokenCan(Abilities::UpdatePost)) {
            return true;
        }

        if ($user->tokenCan(Abilities::UpdateOwnPost)) {
            return $user->id == $post->user_id;
        }

        return false;
    }

    public function delete(User $user, Post $post)
    {

        if ($user->tokenCan(Abilities::DeletePost)) {
            return true;
        }

        if ($user->tokenCan(Abilities::DeleteOwnPost)) {
            return $user->id == $post->user_id;
        }

        return false;
    }
}
