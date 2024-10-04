<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BasePostRequest extends FormRequest
{

    public function mappedAttributes()
    {

        $attributeMap = [
            'title' => 'data.title',
            'status' => 'data.status',
            'content' => 'data.content',
        ];

        $attributesToUpdate = [];
        foreach ($attributeMap as $attribute => $value) {
            if ($this->has($value)) {
                $attributesToUpdate[$attribute] = $this->input($value);
            }
        }

        $attributesToUpdate['slug'] = Str::slug($this->input('title'));

        if ($this->routeIs('posts.store')) { // set user_id only for new posts
            $attributesToUpdate['user_id'] = Auth::user()->id;
        }

        return $attributesToUpdate;
    }
}
