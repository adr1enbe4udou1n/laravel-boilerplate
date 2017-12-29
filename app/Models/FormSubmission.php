<?php

namespace App\Models;

use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormSubmission.
 */
class FormSubmission extends Model
{
    protected $appends = ['can_edit', 'can_delete'];

    public function getCanEditAttribute()
    {
        return false;
    }

    public function getCanDeleteAttribute()
    {
        return Gate::check('access all backend') || Gate::check('delete form_submissions');
    }

    /**
     * @return array
     */
    public function getFormattedDataAttribute()
    {
        return json_decode($this->data);
    }
}
