<?php

namespace App\Models;

use App\Models\Traits\HtmlElements;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $active
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read string $action_buttons
 * @property-read string $activated_label
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User actives()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{

    use Notifiable, HtmlElements;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable
        = [
            'name',
            'email',
            'active',
        ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden
        = [
            'password',
            'remember_token',
        ];

    public function scopeActives(Builder $query)
    {
        return $query->where('active', '=', true);
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
     * @param string $ability
     * @param array  $arguments
     *
     * @return bool
     */
    public function can($ability, $arguments = [])
    {
        foreach ($this->roles as $role) {
            // Validate against the Permission table
            foreach ($role->permissions as $permission) {
                if (str_is($permission, $permission->name)) {
                    return true;
                }
            }
        }

        return parent::can($ability, $arguments);
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
     * @return string
     */
    public function getActivatedLabelAttribute()
    {
        return $this->getBooleanLabelHtml($this->active);
    }

    /**
     * @return string
     */
    public function getActionButtonsAttribute()
    {
        $buttons = $this->getEditButtonHtml('admin.user.edit');

        if ($this->id !== 1 && $this->id !== auth()->id()) {
            if (!session()->has('admin_user_id')) {
                $buttons .= '<a href="'.route(
                        'admin.user.login-as', $this
                    )
                    .'" class="btn btn-xs btn-success"><i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="'
                    .trans(
                        'buttons.login-as', ['name' => $this->name]
                    ).'"></i></a> ';
            }

            $buttons .= $this->getDeleteButtonHtml('admin.user.destroy');
        }

        return $buttons;
    }
}
