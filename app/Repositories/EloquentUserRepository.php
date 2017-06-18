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
use Illuminate\Contracts\Config\Repository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
     * @param string $slug
     *
     * @return User
     */
    public function findBySlug($slug)
    {
        return $this->query()->whereSlug($slug)->first();
    }

    /**
     * @param array $input
     * @param bool  $confirmed
     *
     * @return \App\Models\User
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function store(array $input, $confirmed = false)
    {
        /** @var User $user */
        $user = $this->make(Arr::only($input, ['name', 'email', 'active']));

        if (isset($input['password'])) {
            $user->password = bcrypt($input['password']);
        }
        $user->confirmed = $confirmed;

        if (empty($user->locale)) {
            $user->locale = $this->localization->getDefaultLocale();
        }

        if (empty($user->timezone)) {
            $user->timezone = $this->config->get('app.timezone');
        }

        if (!$user->save()) {
            throw new GeneralException(trans('exceptions.backend.users.create'));
        }

        event(new UserCreated($user));

        $roles = isset($input['roles']) ? $input['roles'] : [];
        $user->roles()->sync($roles);

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
        if ($user->is_super_admin && auth()->user()->id !== 1) {
            throw new GeneralException(trans('exceptions.backend.users.first_user_cannot_be_edited'));
        }

        $user->fill(Arr::except($input, 'password'));

        if ($user->is_super_admin && !$user->active) {
            throw new GeneralException(trans('exceptions.backend.users.first_user_cannot_be_disabled'));
        }

        if (isset($input['password']) && !empty($input['password'])) {
            $user->password = bcrypt($input['password']);
        }

        if (!$user->save()) {
            throw new GeneralException(trans('exceptions.backend.users.update'));
        }

        event(new UserUpdated($user));

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

        if (!$user->delete()) {
            throw new GeneralException(trans('exceptions.backend.users.delete'));
        }

        event(new UserDeleted($user));

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
     * @return string
     */
    public function getActionButtons(User $user)
    {
        $buttons = '';

        // Only super admin user can edit first user
        if ($user->is_super_admin && auth()->user()->id === 1) {
            $buttons .= $this->getEditButtonHtml('admin.user.edit', $user);
        }

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
