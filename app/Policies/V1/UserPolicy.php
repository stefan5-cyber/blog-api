<?php

namespace App\Policies\V1;

use App\Models\User;
use App\Permissions\V1\Abilities;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
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
