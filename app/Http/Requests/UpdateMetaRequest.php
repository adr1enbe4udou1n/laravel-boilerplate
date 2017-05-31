<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMetaRequest extends FormRequest
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
        $meta = $this->route('meta');
        $locale = $this->get('locale');

        return [
            'locale' => 'required',
            'route' => "required|unique:metas,route,{$meta->id},id,locale,$locale",
        ];
    }
}
