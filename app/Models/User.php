<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $password
 * @property bool $active
 * @property string|null $confirmation_token
 * @property int $confirmed
 * @property string|null $remember_token
 * @property string $locale
 * @property string $timezone
 * @property string $slug
 * @property \Carbon\Carbon|null $last_access_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property mixed $avatar
 * @property mixed $formatted_roles
 * @property mixed $is_super_admin
 * @property \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property \Plank\Mediable\MediableCollection|\App\Models\Post[] $posts
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\SocialLogin[] $providers
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User actives()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User findSimilarSlugs(\Illuminate\Database\Eloquent\Model $model, $attribute, $config, $slug)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereConfirmationToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereConfirmed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastAccessAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereTimezone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'last_access_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'active',
        'locale',
        'timezone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'confirmation_token',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
      'avatar',
    ];

    public function scopeActives(Builder $query)
    {
        return $query->where('active', '=', true);
    }

    public function getIsSuperAdminAttribute()
    {
        return 1 === $this->id;
    }

    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function getFormattedRolesAttribute()
    {
        return $this->is_super_admin
            ? __('labels.user.super_admin')
            : $this->roles->implode('display_name', ', ');
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function hasRole($name)
    {
        return $this->roles->contains('name', $name);
    }

    /**
     * @return array
     */
    public function getPermissions()
    {
        $permissions = [];

        foreach ($this->roles as $role) {
            foreach ($role->permissions as $permission) {
                if (! in_array($permission, $permissions, true)) {
                    $permissions[] = $permission;
                }
            }
        }

        // Add children permissions
        foreach (config('permissions') as $name => $permission) {
            if (isset($permission['children']) && in_array($name, $permissions, true)) {
                $permissions = array_merge($permissions, $permission['children']);
            }
        }

        return collect($permissions);
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * @param $provider
     *
     * @return bool
     */
    public function getProvider($provider)
    {
        return $this->providers->first(function (SocialLogin $item) use ($provider) {
            return $item->provider === $provider;
        });
    }

    /**
     * @return mixed
     */
    public function providers()
    {
        return $this->hasMany(SocialLogin::class);
    }

    /**
     * Get user avatar from gravatar.
     */
    public function getAvatarAttribute()
    {
        $hash = md5($this->email);

        return "https://secure.gravatar.com/avatar/{$hash}?size=100&d=mm&r=g";
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function __toString()
    {
        return $this->name;
    }
}
