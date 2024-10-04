<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Validation\Rule;

class UpdateUserRequest extends BaseUserRequest
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

        $userId = $this->routeIs('authors.update') ? $this->author : $this->user;

        $rules = [
            'data.name' => ['sometimes', 'string'],
            'data.email' => ['sometimes', 'email', Rule::unique('users', 'email')->ignore($userId, 'id')],
        ];

        if ($this->routeIs('users.update')) {
            $rules = [
                ...$rules,
                'data.password' => ['sometimes', 'string'],
                'data.role' => ['sometimes', 'string', 'in:user,author,admin'],
                'data.is_admin' => ['sometimes', 'boolean']
            ];
        }

        return $rules;
    }
}
