<?php

namespace App\Models;

use Illuminate\Support\Facades\Gate;
use App\Models\Traits\TranslatableJson;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Role.
 *
 * @property int                                                               $id
 * @property string                                                            $name
 * @property array                                                             $display_name
 * @property array                                                             $description
 * @property int                                                               $order
 * @property \Carbon\Carbon|null                                               $created_at
 * @property \Carbon\Carbon|null                                               $updated_at
 * @property mixed                                                             $can_delete
 * @property mixed                                                             $can_edit
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    use HasTranslations;
    use TranslatableJson;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatable = [
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
        'display_name',
        'description',
    ];

    /**
     * The relationship that are eager loaded.
     *
     * @var array
     */
    protected $with = [
        'permissions',
    ];

    protected $appends = ['can_edit', 'can_delete'];

    public function getCanEditAttribute()
    {
        return true;
    }

    public function getCanDeleteAttribute()
    {
        return Gate::check('delete roles');
    }

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
