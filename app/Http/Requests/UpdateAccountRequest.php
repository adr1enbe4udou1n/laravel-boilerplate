<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateAccountRequest extends FormRequest
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
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $request->headers->set('referer', route('user.account').'#edit');

        return [
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users,email,'.auth()->id(),
            'locale' => 'required',
            'timezone' => 'required',
        ];
    }
}
