<?php

namespace App\Policies\V1;

use App\Models\Post;
use App\Models\User;
use App\Permissions\V1\Abilities;

class PostPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
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
}
