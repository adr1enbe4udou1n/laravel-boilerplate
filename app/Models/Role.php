<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Role.
 *
 * @property int $id
 * @property string $name
 * @property int $order
 * @property string $display_name
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property array $permissions
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\RoleTranslation[] $translations
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role listsTranslations($translationField)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role notTranslatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role orWhereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role orWhereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role translated()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role translatedIn($locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereOrder($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereTranslation($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereTranslationLike($key, $value, $locale = null)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Role withTranslation()
 * @mixin \Eloquent
 */
class Role extends Model
{
    use Translatable;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = [
        'display_name',
        'description',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'order',
    ];

    /**
     * The relationship that are eager loaded.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function getPermissionsAttribute()
    {
        return $this->permissions()->getResults()->pluck('name')->toArray();
    }

    public function __toString()
    {
        return $this->display_name ?: $this->name;
    }
}
