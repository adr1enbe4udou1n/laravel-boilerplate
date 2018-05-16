<?php

namespace App\Models;

use Illuminate\Support\Facades\Gate;
use App\Models\Traits\TranslatableJson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Meta.
 *
 * @property int                                           $id
 * @property string|null                                   $route
 * @property string|null                                   $metable_type
 * @property int|null                                      $metable_id
 * @property \Carbon\Carbon|null                           $created_at
 * @property \Carbon\Carbon|null                           $updated_at
 * @property mixed                                         $can_delete
 * @property mixed                                         $can_edit
 * @property \Illuminate\Database\Eloquent\Model|\Eloquent $metable
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereMetableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereMetableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property array $title
 * @property array $description
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Meta whereTitle($value)
 */
class Meta extends Model
{
    use HasTranslations;
    use TranslatableJson;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = [
        'title',
        'description',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route',
        'title',
        'description',
    ];

    protected $appends = ['can_edit', 'can_delete'];

    public function getCanEditAttribute()
    {
        return true;
    }

    public function getCanDeleteAttribute()
    {
        return Gate::check('delete metas');
    }

    public function metable()
    {
        return $this->morphTo();
    }
}
