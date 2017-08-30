<?php

namespace App\Repositories;

use App\Events\UserCreated;
use App\Events\UserDeleted;
use App\Events\UserUpdated;
use App\Exceptions\GeneralException;
use App\Models\User;
use App\Repositories\Contracts\RoleRepository;
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
     * @var RoleRepository
     */
    protected $roles;

    /**
     * EloquentUserRepository constructor.
     *
     * @param User                                             $user
     * @param \App\Repositories\Contracts\RoleRepository       $roles
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     * @param \Illuminate\Contracts\Config\Repository          $config
     */
    public function __construct(
        User $user,
        RoleRepository $roles,
        LaravelLocalization $localization,
        Repository $config
    ) {
        parent::__construct($user);
        $this->roles = $roles;
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
     * @throws \App\Exceptions\GeneralException
     *
     * @return \App\Models\User
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

        if (!$this->save($user, $input)) {
            throw new GeneralException(trans('exceptions.backend.users.create'));
        }

        event(new UserCreated($user));

        return $user;
    }

    /**
     * @param User  $user
     * @param array $input
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\User
     */
    public function update(User $user, array $input)
    {
        if (!$this->canEdit($user)) {
            throw new GeneralException(trans('exceptions.backend.users.first_user_cannot_be_edited'));
        }

        $user->fill(Arr::except($input, 'password'));

        if ($user->is_super_admin && !$user->active) {
            throw new GeneralException(trans('exceptions.backend.users.first_user_cannot_be_disabled'));
        }

        if (!$this->save($user, $input)) {
            throw new GeneralException(trans('exceptions.backend.users.update'));
        }

        event(new UserUpdated($user));

        return $user;
    }

    /**
     * @param \App\Models\User $user
     * @param array            $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    private function save(User $user, array $input)
    {
        if (isset($input['password']) && !empty($input['password'])) {
            $user->password = bcrypt($input['password']);
        }

        if (!$user->save()) {
            return false;
        }

        $roles = isset($input['roles']) ? explode(',', $input['roles']) : [];

        if (!empty($roles)) {
            $allowedRoles = $this->roles->getAllowedRoles()->keyBy('id');

            foreach ($roles as $id) {
                if (!$allowedRoles->has($id)) {
                    throw new GeneralException(trans('exceptions.backend.users.cannot_set_superior_roles'));
                }
            }
        }

        $user->roles()->sync($roles);

        return true;
    }

    /**
     * @param User $user
     *
     * @throws \Exception|\Throwable
     *
     * @return bool|null
     */
    public function destroy(User $user)
    {
        if (!$this->canDelete($user)) {
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
     * @throws \Exception|\Throwable
     *
     * @return mixed
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
     * @throws \Exception|\Throwable
     *
     * @return mixed
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
     * @throws \Exception|\Throwable
     *
     * @return mixed
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

        /** @var \Illuminate\Support\Collection $permissions */
        $permissions = session()->get('permissions');

        if ($permissions->isEmpty()) {
            return false;
        }

        return $permissions->contains($name);
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

    public function canEdit(User $user)
    {
        return !$user->is_super_admin || auth()->id() === 1;
    }

    public function canDelete(User $user)
    {
        return !$user->is_super_admin && $user->id !== auth()->id();
    }

    /**
     * @param \App\Models\User $user
     *
     * @return string
     */
    public function getActionButtons(User $user)
    {
        $buttons = '';

        // Only super admin user can edit himself
        if ($this->canEdit($user)) {
            $buttons .= $this->getEditButtonHtml("#/users/{$user->id}/edit");
        }

        if ($this->canImpersonate($user)) {
            $title
                = '<i class="icon-lock" data-toggle="tooltip" data-placement="top" title="'
                .trans('buttons.login-as', ['name' => $user->name]).'"></i>';

            $route = route('login-as', $user);

            $buttons .= "<a href=\"{$route}\" class=\"btn btn-sm btn-warning\">{$title}</a> ";
        }

        if ($this->canDelete($user)) {
            $buttons .= $this->getDeleteButtonHtml('admin.users.destroy', $user, 'delete users');
        }

        return $buttons;
    }
}
