<?php

namespace App\Http\Requests\Api\V1;


class StoreUserRequest extends BaseUserRequest
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
            'data.name' => ['required', 'string'],
            'data.email' => ['required', 'email', 'unique:users,email'],
            'data.password' => ['required', 'string'],
            'data.role' => ['required', 'string', 'in:user,author,admin'],
            'data.is_admin' => ['required', 'boolean']
        ];
    }
}
