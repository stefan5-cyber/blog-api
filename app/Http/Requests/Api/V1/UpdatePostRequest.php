<?php

namespace App\Http\Requests\Api\V1;

use App\Http\Requests\Api\V1\BasePostRequest;
use Illuminate\Validation\Rule;


class UpdatePostRequest extends BasePostRequest
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
            'data.title' => ['sometimes', 'string', Rule::unique('posts', 'title')->ignore($this->post)],
            'data.content' => ['sometimes', 'string'],
            'data.status' => ['sometimes', 'string', 'in:A,D,X']
        ];
    }
}
