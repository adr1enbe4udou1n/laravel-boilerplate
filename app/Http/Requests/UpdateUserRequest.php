<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');

        return [
            'email'                 => 'required|email|unique:users,email,'.$user->id,
            'name'                  => 'required|unique:users,name,'.$user->id,
            'password'              => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6',
            'active'                => 'boolean',
        ];
    }
}
