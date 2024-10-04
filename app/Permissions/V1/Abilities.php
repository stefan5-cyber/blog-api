<?php

namespace App\Permissions\V1;


final class Abilities
{
    public const AdminStuff = 'admin:stuff';

    public const StorePost = 'post:store';
    public const UpdatePost = 'post:update';
    public const DeletePost = 'post:delete';

    public const UpdateOwnPost = 'post:own:update';
    public const DeleteOwnPost = 'post:own:delete';

    public const StoreUser = 'user:store';
    public const UpdateUser = 'user:update';
    public const DeleteUser = 'user:delete';


    public static function getAbilities($user)
    {
        if ($user->role == 'admin') {
            return [
                self::AdminStuff,
                self::StorePost,
                self::UpdatePost,
                self::DeletePost,
                self::StoreUser,
                self::UpdateUser,
                self::DeleteUser
            ];
        }

        if ($user->role == 'author') {
            return [
                self::AdminStuff,
                self::StorePost,
                self::UpdateOwnPost,
                self::DeleteOwnPost,
            ];
        }

        return [];
    }
}
