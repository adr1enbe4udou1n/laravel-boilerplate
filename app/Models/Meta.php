<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Meta
 *
 * @property int $id
 * @property string $locale
 * @property string $route
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereRoute($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Meta extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'locale',
            'route',
            'title',
            'description',
        ];
}
