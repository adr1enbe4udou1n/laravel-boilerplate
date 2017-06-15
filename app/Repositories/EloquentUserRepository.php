<?php

namespace App\Repositories;

use App\Events\UserCreated;
use App\Events\UserDeleted;
use App\Events\UserUpdated;
use App\Exceptions\GeneralException;
use App\Models\User;
use App\Notifications\SendConfirmation;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\LaravelLocalization;

/**
 * Class EloquentUserRepository.
 */
class EloquentUserRepository extends EloquentBaseRepository implements UserRepository
{
    use HtmlActionsButtons;

    /**
     * @var \Mcamara\LaravelLocalization\LaravelLocalization
     */
    protected $localization;

    /**
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * EloquentUserRepository constructor.
     *
     * @param User                                             $user
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     * @param \Illuminate\Contracts\Config\Repository          $config
     */
    public function __construct(User $user, LaravelLocalization $localization, Repository $config)
    {
        parent::__construct($user);
        $this->localization = $localization;
        $this->config = $config;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->query()->select([
            'id',
            'name',
            'email',
            'active',
            'confirmed',
            'last_access_at',
            'created_at',
            'updated_at',
        ])->with('roles');
    }

    /**
     * @param array $input
     *
     * @param bool  $withConfirm
     *
     * @return \App\Models\User
     * @throws \Throwable
     * @throws \Exception
     */
    public function store(array $input, $withConfirm = true)
    {
        /** @var User $user */
        $user = $this->make($input);
        $user->password = bcrypt($input['password']);

        if (empty($user->locale)) {
            $user->locale = $this->localization->getDefaultLocale();
        }

        if (empty($user->timezone)) {
            $user->timezone = $this->config->get('app.timezone');
        }

        DB::transaction(function () use ($user) {
            if ($user->save()) {
                event(new UserCreated($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.users.create'));
        });

        $roles = isset($input['roles']) ? $input['roles'] : [];
        $user->roles()->sync($roles);

        if ($withConfirm) {
            $this->sendConfirmationToUser($user);
        }

        return $user;
    }

    /**
     * @param User  $user
     * @param array $input
     *
     * @return \App\Models\User
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     */
    public function update(User $user, array $input)
    {
        DB::transaction(function () use ($user, $input) {
            if ($user->update($input)) {
                if ($user->is_super_admin && !$user->active) {
                    throw new GeneralException(trans('exceptions.backend.users.first_user_cannot_be_disabled'));
                }

                if (isset($input['password']) && !empty($input['password'])) {
                    $user->password = bcrypt($input['password']);
                }
                $user->save();

                event(new UserUpdated($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.users.update'));
        });

        $roles = isset($input['roles']) ? $input['roles'] : [];
        $user->roles()->sync($roles);

        return $user;
    }

    /**
     * @param User $user
     *
     * @return bool|null
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(User $user)
    {
        if ($user->is_super_admin) {
            throw new GeneralException(trans('exceptions.backend.users.first_user_cannot_be_destroyed'));
        }

        DB::transaction(function () use ($user) {
            if ($user->delete()) {
                event(new UserDeleted($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.users.delete'));
        });

        return true;
    }

    /**
     * @param array $ids
     *
     * @return mixed
     *
     * @throws \Exception|\Throwable
     */
    public function batchDestroy(array $ids)
    {
        DB::transaction(function () use ($ids) {
            // This wont call eloquent events, change to destroy if needed
            if ($this->query()->whereIn('id', $ids)->delete()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.users.delete'));
        });

        return true;
    }

    /**
     * @param array $ids
     *
     * @return mixed
     *
     * @throws \Exception|\Throwable
     */
    public function batchEnable(array $ids)
    {
        DB::transaction(function () use ($ids) {
            if ($this->query()->whereIn('id', $ids)
                ->update(['active' => true])
            ) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.users.update'));
        });

        return true;
    }

    /**
     * @param array $ids
     *
     * @return mixed
     *
     * @throws \Exception|\Throwable
     */
    public function batchDisable(array $ids)
    {
        DB::transaction(function () use ($ids) {
            if ($this->query()->whereIn('id', $ids)
                ->update(['active' => false])
            ) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.users.update'));
        });

        return true;
    }

    /**
     * @param $input
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function updateAccount($input)
    {
        $user = auth()->user();

        /** @var User $user */
        $user = $this->query()->find($user->id);

        $user->update(Arr::only($input, ['name', 'email', 'locale', 'timezone']));

        if ($user->email !== $input['email']) {
            //Emails have to be unique
            if ($this->query()->findByEmail($input['email'])) {
                throw new GeneralException(trans('exceptions.frontend.user.email_taken'));
            }
        }

        return $user->save();
    }

    /**
     * @param $oldPassword
     * @param $newPassword
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function changePassword($oldPassword, $newPassword)
    {
        $user = auth()->user();

        $user = $this->query()->find($user->id);

        if (Hash::check($oldPassword, $user->password)) {
            $user->password = bcrypt($newPassword);

            return $user->save();
        }

        throw new GeneralException(trans('exceptions.frontend.user.password_mismatch'));
    }

    /**
     * Send mail confirmation
     */
    public function sendConfirmation()
    {
        $user = auth()->user();

        /** @var User $user */
        $user = $this->query()->find($user->id);

        $this->sendConfirmationToUser($user);
    }

    /**
     * @param \App\Models\User $user
     */
    private function sendConfirmationToUser(User $user)
    {
        $user->confirmation_token = Str::random(60);
        $user->save();

        $user->notify(new SendConfirmation($user->confirmation_token));
    }

    /**
     * Send mail confirmation
     *
     * @param $token
     *
     * @return string|void
     */
    public function confirmEmail($token)
    {
        $user = auth()->user();

        /** @var User $user */
        $user = $this->query()->find($user->id);

        if ($user->confirmation_token === $token) {
            $user->confirmed = true;
            $user->save();
        }
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException|Exception
     */
    public function deleteAccount()
    {
        $user = auth()->user();

        /** @var User $user */
        $user = $this->query()->find($user->id);

        if ($user->is_super_admin) {
            throw new GeneralException(trans('exceptions.backend.users.first_user_cannot_be_destroyed'));
        }

        if (!$user->delete()) {
            throw new GeneralException(trans('exceptions.frontend.user.delete_account'));
        }

        return true;
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    private function loadPermissions(Authenticatable $user)
    {
        session(['permissions' => $user->getPermissions()]);
    }

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param                                            $name
     *
     * @return bool
     */
    public function hasPermission(Authenticatable $user, $name)
    {
        // First user is always super admin and cannot be deleted
        if ($user->is_super_admin) {
            return true;
        }

        $permissions = session()->get('permissions');

        if (empty($permissions)) {
            return false;
        }

        foreach ($permissions as $permission) {
            if (str_is($name, $permission)) {
                return true;
            }
        }

        return false;
    }

    private function canImpersonate(User $user)
    {
        $authenticatedUser = auth()->user();

        if ($this->hasPermission($authenticatedUser, 'impersonate users')) {
            return !$user->is_super_admin
                && session()->get('admin_user_id') !== $user->id
                && $user->id !== $authenticatedUser->id;
        }

        return false;
    }

    private function canDelete(User $user)
    {
        $authenticatedUser = auth()->user();

        return !$user->is_super_admin && $user->id !== $authenticatedUser->id;
    }

    /**
     * @param \App\Models\User $user
     *
     * @return \App\Models\User
     * @throws \App\Exceptions\GeneralException
     */
    public function login(User $user)
    {
        $user->last_access_at = Carbon::now();

        if (!$user->save()) {
            throw new GeneralException(trans('exceptions.backend.users.update'));
        }

        $this->loadPermissions($user);

        return $user;
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws Exception
     */
    public function loginAs(User $user)
    {
        $authenticatedUser = auth()->user();

        if ($authenticatedUser->id === $user->id
            || session()->get('admin_user_id') === $user->id
        ) {
            return redirect()->route('admin.home');
        }

        if (!session()->get('admin_user_id')) {
            session(['admin_user_id' => $authenticatedUser->id]);
            session(['admin_user_name' => $authenticatedUser->name]);
            session(['temp_user_id' => $user->id]);
        }

        //Login user
        auth()->loginUsingId($user->id);
        $this->loadPermissions($user);

        return redirect(home_route());
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        if ($admin_id = session()->get('admin_user_id')) {
            $this->flushTempSession();
            $user = auth()->loginUsingId((int) $admin_id);
            $this->loadPermissions($user);
        }

        return redirect()->route('admin.home');
    }

    /**
     * Remove old session variables from admin logging in as user.
     */
    private function flushTempSession()
    {
        session()->forget('admin_user_id');
        session()->forget('admin_user_name');
        session()->forget('temp_user_id');
    }

    /**
     * @param \App\Models\User $user
     *
     * @return string
     */
    public function getActionButtons(User $user)
    {
        $buttons = $this->getEditButtonHtml('admin.user.edit', $user);

        if ($this->canImpersonate($user)) {
            $title = '<i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="'.trans('buttons.login-as', ['name' => $user->name]).'"></i>';
            $buttons .= link_to(route('login-as', $user), $title, [
                'class' => 'btn btn-xs btn-warning',
            ], false, false).' ';
        }

        if ($this->canDelete($user)) {
            $buttons .= $this->getDeleteButtonHtml('admin.user.destroy', $user);
        }

        return $buttons;
    }
}
