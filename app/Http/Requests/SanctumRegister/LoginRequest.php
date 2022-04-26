<?php

namespace App\Http\Requests\SanctumRegister;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
        return ([
            'username'    => 'required|string|exists:users,username',
            'password'    => 'required|max:30|min:5',
        ]);
    }
}