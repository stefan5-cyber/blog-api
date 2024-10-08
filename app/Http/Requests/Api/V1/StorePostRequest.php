<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\V1\BasePostRequest;


class StorePostRequest extends BasePostRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data' => ['required', 'array'],
            'data.title' => ['required', 'string', 'unique:posts,title'],
            'data.content' => ['required', 'string'],
            'data.status' => ['required', 'string', 'in:A,D,X']
        ];
    }
}
