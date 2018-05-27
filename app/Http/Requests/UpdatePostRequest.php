<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        return [
            'title'          => 'required',
            'featured_image' => 'nullable|mimes:jpeg,jpg,png,gif',
            'status'         => 'in:publish,draft',
            'published_at'   => 'nullable|date',
            'unpublished_at' => 'nullable|date',
            'pinned'         => 'boolean',
            'promoted'       => 'boolean',
        ];
    }
}
