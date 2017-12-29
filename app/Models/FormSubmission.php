<?php

namespace App\Models;

use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormSubmission.
 *
 * @property int $id
 * @property string $type
 * @property string $data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSubmission whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSubmission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSubmission whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSubmission whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property array $formatted_data
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
