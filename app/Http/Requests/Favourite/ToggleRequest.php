<?php
declare(strict_types = 1);

namespace App\Http\Requests\Favourite;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read int $id
 * @property-read boolean $checked
 */
class ToggleRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return !auth()->guest();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer',
            'checked' => 'required|boolean',
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return (int) $this->id;
    }

    /**
     * @return bool
     */
    public function getChecked(): bool
    {
        return (bool) $this->checked;
    }
}
