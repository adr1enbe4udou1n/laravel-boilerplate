<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRedirectionRequest extends FormRequest
{
    /**
     * Determine if the meta is authorized to make this request.
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
        $redirection = $this->route('redirection');

        return [
            'path' => "required|unique:redirections,path,{$redirection->id}",
            'locale' => 'required',
            'route' => 'required',
            'type' => 'required',
        ];
    }
}
