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
     * @queryParam sort string Data field(s). Example: title,-status
     * @queryParam filter[title] Filter by title. Wildcards are supported. Example: *fix*
     * @queryParam filter[status] Filter by status code: A,D,X. No-example
     * @queryParam filter[createdAt] Filter by created_at. No-example
     * @queryParam filter[updatedAt] Filter by updated_at. No-example
     *
     */
    public function index($author_id, PostFilter $filters)
    {
        return PostResource::collection(Post::where('user_id', $author_id)->filter($filters)->paginate());
    }
}
