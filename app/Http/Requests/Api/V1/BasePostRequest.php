<?php

namespace App\http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BasePostRequest extends FormRequest
{


    public function mappedAttributes()
    {

        $attributeMap = [
            'title' => 'data.title',
            'status' => 'data.status',
            'content' => 'data.content',
            'user_id' => Auth::user()->id
        ];

        $attributesToUpdate = [];
        foreach ($attributeMap as $attribute => $value) {
            if ($this->has($value)) {
                $attributesToUpdate[$attribute] = $this->input($value);
            }
        }

        return $attributesToUpdate;
    }
}
