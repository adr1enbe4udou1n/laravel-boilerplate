<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormSubmission.
 *
 * @property int $id
 * @property string $type
 * @property string $data
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSubmission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSubmission whereData($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSubmission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSubmission whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\FormSubmission whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property array $formatted_data
 */
class FormSubmission extends Model
{
    /**
     * @return array
     */
    public function getFormattedDataAttribute()
    {
        return json_decode($this->data);
    }
}
