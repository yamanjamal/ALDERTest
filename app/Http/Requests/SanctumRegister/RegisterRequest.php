<?php

namespace App\Http\Requests\SanctumRegister;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' =>'required|string|exists:users,username',
            'name'     =>'required|string',
            'email'    =>'nullable|string',
            'password' =>'required|confirmed',
            // 'role'     =>'required|exists:user_roles,name',
        ];
    }
}
