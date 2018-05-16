<?php

namespace App\Models;

use Illuminate\Support\Facades\Gate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Redirection.
 *
 * @property int                 $id
 * @property string              $source
 * @property bool                $active
 * @property string              $target
 * @property string              $type
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property mixed               $can_delete
 * @property mixed               $can_edit
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Redirection actives()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Redirection whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Redirection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Redirection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Redirection whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Redirection whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Redirection whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Redirection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Redirection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source',
        'active',
        'target',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    protected $appends = ['can_edit', 'can_delete'];

    public function getCanEditAttribute()
    {
        return true;
    }

    public function getCanDeleteAttribute()
    {
        return Gate::check('delete redirections');
    }

    public function scopeActives(Builder $query)
    {
        return $query->where('active', '=', true);
    }
}
