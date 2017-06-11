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
            'target' => "required|unique:redirections,target,{$redirection->id}",
            'source' => 'required',
            'type' => 'required',
        ];
    }
}
