<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Exception;

/**
 * Class EloquentRoleRepository.
 */
class EloquentRoleRepository extends EloquentBaseRepository implements RoleRepository
{
    use HtmlActionsButtons;

    /**
     * EloquentRoleRepository constructor.
     *
     * @param Role $role
     */
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }

    /**
     * @param array $input
     *
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\Role
     */
    public function store(array $input)
    {
        /** @var Role $role */
        $role = $this->make($input);

        if (!$this->save($role, $input)) {
            throw new GeneralException(trans('exceptions.backend.roles.create'));
        }

        return $role;
    }

    /**
     * @param Role  $role
     * @param array $input
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     *
     * @return \App\Models\Role
     */
    public function update(Role $role, array $input)
    {
        $role->fill($input);

        if (!$this->save($role, $input)) {
            throw new GeneralException(trans('exceptions.backend.roles.update'));
        }

        return $role;
    }

    /**
     * @param \App\Models\Role $role
     * @param array            $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    private function save(Role $role, array $input)
    {
        if (!$role->save($input)) {
            return false;
        }

        $role->permissions()->delete();

        $permissions = $input['permissions'] ?? [];

        foreach ($permissions as $name) {
            $role->permissions()->create(['name' => $name]);
        }

        return true;
    }

    /**
     * @param Role $role
     *
     * @throws \Exception|\Throwable
     *
     * @return bool|null
     */
    public function destroy(Role $role)
    {
        if (!$role->delete()) {
            throw new GeneralException(trans('exceptions.backend.roles.delete'));
        }

        return true;
    }

    /**
     * Get only roles than current can attribute to the others.
     */
    public function getAllowedRoles()
    {
        $authenticatedUser = auth()->user();

        if (!$authenticatedUser) {
            return [];
        }

        $roles = $this->query()->with('permissions')->orderBy('order')->get();

        if ($authenticatedUser->is_super_admin) {
            return $roles;
        }

        /** @var \Illuminate\Support\Collection $permissions */
        $permissions = $authenticatedUser->getPermissions();

        $roles = $roles->filter(function (Role $role) use ($permissions) {
            foreach ($role->permissions as $permission) {
                if (false === $permissions->search($permission, true)) {
                    return false;
                }
            }

            return true;
        });

        return $roles;
    }

    /**
     * @param \App\Models\Role $role
     *
     * @return mixed
     */
    public function getActionButtons(Role $role)
    {
        $buttons = $this->getEditButtonHtml("#/roles/{$role->id}/edit")
            .$this->getDeleteButtonHtml('admin.roles.destroy', $role, 'delete roles');

        return $buttons;
    }
}
