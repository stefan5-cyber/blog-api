<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;


class BaseUserRequest extends FormRequest
{

    public function mappedAttributes()
    {

        $attributeMap = [
            'name' => 'data.name',
            'email' => 'data.email'
        ];

        if ($this->routeIs('users.store') || $this->routeIs('users.update')) {
            $attributeMap = [
                'name' => 'data.name',
                'email' => 'data.email',
                'password' => 'data.password',
                'role' => 'data.role',
                'is_admin' => 'data.is_admin'
            ];
        }

        $attributesToUpdate = [];
        foreach ($attributeMap as $attribute => $value) {
            if ($this->has($value)) {
                $attributesToUpdate[$attribute] = $this->input($value);
            }
        }

        return $attributesToUpdate;
    }
}
