<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Meta.
 *
 * @property int $id
 * @property string $route
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\MetaTranslation[] $translations
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta listsTranslations($translationField)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta translated()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta translatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereRoute($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta withTranslation()
 * @mixin \Eloquent
 *
 * @property \Illuminate\Database\Eloquent\Model|\Eloquent $metable
 * @property int $metable_id
 * @property string $metable_type
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereMetableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Meta whereMetableType($value)
 */
class Meta extends Model
{
    use Translatable;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
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
    ];

    /**
     * The relationship that are eager loaded.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    public function metable()
    {
        return $this->morphTo();
    }
}
