<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMetaRequest extends FormRequest
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
        $locale = $this->get('locale');

        return [
            'locale' => 'required',
            'route' => 'required|unique:metas,route,NULL,id,locale,'.$locale,
        ];
    }
}
