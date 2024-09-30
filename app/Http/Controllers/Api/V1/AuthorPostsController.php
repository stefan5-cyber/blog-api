<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\PostResource;
use App\Http\Controllers\Controller;
use App\Http\Filters\V1\PostFilter;
use App\Models\Post;


class AuthorPostsController extends Controller
{
    public function index($author_id, PostFilter $filters)
    {
        return PostResource::collection(Post::where('user_id', $author_id)->filter($filters)->paginate());
    }
}
