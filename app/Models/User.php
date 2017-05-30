<?php

namespace App\Models;

use App\Models\Traits\HtmlElements;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;

/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $active
 * @property bool $role
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read string $action_buttons
 * @property-read string $activated_label
 * @property-read mixed $is_admin
 * @property-read mixed $is_client
 * @property-read mixed $is_super_admin
 * @property-read mixed $is_supervisor
 * @property-read mixed $role_label
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User actives()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HtmlElements;

    const ROLE_ADMIN = -1;
    const ROLE_SUPERVISOR = 0;
    const ROLE_CLIENT = 1;

    /**
     * @return array
     */
    public static function getRoles()
    {
        return [
            self::ROLE_ADMIN => trans('labels.backend.users.roles.administrator'),
            self::ROLE_SUPERVISOR => trans('labels.backend.users.roles.supervisor'),
            self::ROLE_CLIENT => trans('labels.backend.users.roles.client'),
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'active', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getIsSuperAdminAttribute()
    {
        return $this->id === 1;
    }

    public function getIsAdminAttribute()
    {
        return $this->role === self::ROLE_ADMIN || $this->is_super_admin;
    }

    public function getIsSupervisorAttribute()
    {
        return $this->role === self::ROLE_SUPERVISOR || $this->is_admin;
    }

    public function getIsClientAttribute()
    {
        return $this->role === self::ROLE_CLIENT || $this->is_supervisor;
    }

    public function getRoleLabelAttribute()
    {
        return self::getRoles()[$this->role];
    }

    public function scopeActives(Builder $query)
    {
        return $query->where('active', '=', true);
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

        if (!$this->is_super_admin && $this->id !== auth()->id()) {
            if (!session()->has('admin_user_id')) {
                $buttons .= '<a href="'.route(
                        'admin.user.login-as', $this
                    ).'" class="btn btn-xs btn-success"><i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="'.trans(
                        'buttons.login-as', ['name' => $this->name]
                    ).'"></i></a> ';
            }

            $buttons .= $this->getDeleteButtonHtml('admin.user.destroy');
        }

        return $buttons;
    }
}
