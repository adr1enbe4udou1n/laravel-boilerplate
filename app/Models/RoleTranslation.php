<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RoleTranslation.
 *
 * @property int $id
 * @property int $role_id
 * @property string $locale
 * @property string $display_name
 * @property string $description
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleTranslation whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleTranslation whereDisplayName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleTranslation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleTranslation whereLocale($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleTranslation whereRoleId($value)
 * @mixin \Eloquent
 *
 * @property int $order
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\RoleTranslation whereOrder($value)
 */
class RoleTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['display_name', 'description'];
}
