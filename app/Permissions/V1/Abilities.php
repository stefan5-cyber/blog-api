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

    public const IndexUser = 'user:index';
    public const ShowUser = 'user:show';
    public const StoreUser = 'user:store';
    public const UpdateUser = 'user:update';
    public const DeleteUser = 'user:delete';

    public const UpdateOwnProfile = 'author:update';

    public static function getAbilities($user)
    {
        if ($user->role == 'admin') {
            return [
                self::AdminStuff,
                self::StorePost,
                self::UpdatePost,
                self::DeletePost,
                self::IndexUser,
                self::ShowUser,
                self::StoreUser,
                self::UpdateUser,
                self::DeleteUser,
            ];
        }

        if ($user->role == 'author') {
            return [
                self::AdminStuff,
                self::StorePost,
                self::UpdateOwnPost,
                self::DeleteOwnPost,
                self::UpdateOwnProfile
            ];
        }

        return [];
    }
}
