<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\Api\V1\PostResource;
use App\Http\Controllers\Controller;
use App\Http\Filters\V1\PostFilter;
use App\Models\Post;


class AuthorPostsController extends Controller
{

    /**
     * Get posts for given Author
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
     */
    public function index($author_id, PostFilter $filters)
    {
        return PostResource::collection(Post::where('user_id', $author_id)->filter($filters)->paginate());
    }
}
