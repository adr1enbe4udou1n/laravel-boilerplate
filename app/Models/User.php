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
 * @property-read mixed $is_super_admin
 * @property-read mixed $is_supervisor
 * @property-read mixed $role_label
 * @property-read mixed $activated_label
 * @property-read mixed $action_buttons
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereActive($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRole($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User actives()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, HtmlElements;

    const ROLE_ADMIN = -1;
    const ROLE_SUPERVISOR = 0;

    /**
     * @return array
     */
    public static function getRoles()
    {
        return [
            self::ROLE_ADMIN => 'Administrateur',
            self::ROLE_SUPERVISOR => 'Superviseur',
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
        return $this->role == self::ROLE_ADMIN;
    }

    public function getIsSupervisorAttribute()
    {
        return $this->role == self::ROLE_SUPERVISOR;
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

        if (!session()->has('admin_user_id') && $this->id != auth()->id()) {
            $buttons .= '<a href="'.route(
                    'admin.user.login-as', $this
                ).'" class="btn btn-xs btn-success"><i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="'.trans(
                    'buttons.backend.login-as', ['name' => $this->name]
                ).'"></i></a> ';
        }

        if ($this->id != auth()->id()) {
            $buttons .= $this->getDeleteButtonHtml('admin.user.destroy');
        }

        return $buttons;
    }
}
