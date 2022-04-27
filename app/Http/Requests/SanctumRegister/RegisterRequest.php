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
            'username' =>'required|string|unique:users,username',
            'name'     =>'required|string',
            'email'    =>'nullable|string|email',
            'password' =>'required|confirmed',
            'role_id'  =>'required|exists:roles,id',
        ];
    }
}
