<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Redirection.
 *
 * @property int $id
 * @property string $source
 * @property bool $active
 * @property string $target
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection actives()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereTarget($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Redirection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Redirection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'source',
            'active',
            'target',
            'type',
        ];

    public function scopeActives(Builder $query)
    {
        return $query->where('active', '=', true);
    }
}
