<?php

namespace App\Repositories;

use App\Events\UserCreated;
use App\Events\UserDeleted;
use App\Events\UserUpdated;
use App\Exceptions\GeneralException;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class EloquentUserRepository.
 */
class EloquentUserRepository extends BaseRepository implements UserRepository
{
    use HtmlActionsButtons;

    /**
     * Associated Repository Model.
     */
    const MODEL = User::class;

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
            'created_at',
            'updated_at',
        ])->with('roles');
    }

    /**
     * @param  $input
     *
     * @return \App\Models\User
     *
     * @throws \Exception|\Throwable
     */
    public function store($input)
    {
        $user = self::MODEL;

        /** @var User $user */
        $user = new $user($input);
        $user->password = bcrypt($input['password']);

        DB::transaction(function () use ($user) {
            if ($user->save()) {
                event(new UserCreated($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.users.create'));
        });

        $roles = isset($input['roles']) ? $input['roles'] : [];
        $user->roles()->sync($roles);

        return $user;
    }

    /**
     * @param User $user
     * @param      $input
     *
     * @return \App\Models\User
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     */
    public function update(User $user, $input)
    {
        DB::transaction(function () use ($user, $input) {
            if ($user->update($input)) {
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
     * @throws \Exception|\Throwable
     *
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
     * @throws \Exception|\Throwable
     *
     */
    public function batchEnable(array $ids)
    {
        DB::transaction(function () use ($ids) {
            if ($this->query()->whereIn('id', $ids)->update(['active' => true])) {
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
     * @throws \Exception|\Throwable
     *
     */
    public function batchDisable(array $ids)
    {
        DB::transaction(function () use ($ids) {
            if ($this->query()->whereIn('id', $ids)->update(['active' => false])) {
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
    public function updateProfile($input)
    {
        $user = auth()->user();

        $user = $this->query()->find($user->id);
        $user->name = $input['name'];
        $user->email = $input['email'];

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
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    public function loadPermissions(Authenticatable $user)
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
            $buttons .= '<a href="'.route(
                    'login-as', $user
                )
                .'" class="btn btn-xs btn-success"><i class="fa fa-lock" data-toggle="tooltip" data-placement="top" title="'
                .trans(
                    'buttons.login-as', ['name' => $user->name]
                ).'"></i></a> ';
        }

        if ($this->canDelete($user)) {
            $buttons .= $this->getDeleteButtonHtml('admin.user.destroy', $user);
        }

        return $buttons;
    }
}
