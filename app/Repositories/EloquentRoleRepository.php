<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Exception;
use Illuminate\Support\Arr;

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
     * @return \App\Models\Role
     *
     * @throws \Exception|\Throwable
     */
    public function store(array $input)
    {
        /** @var Role $role */
        $role = $this->make(Arr::except($input, ['permissions']));

        if (!$role->save()) {
            throw new GeneralException(trans('exceptions.backend.roles.create'));
        }

        $permissions = isset($input['permissions']) ? $input['permissions'] : [];

        foreach ($permissions as $name) {
            $role->permissions()->create(['name' => $name]);
        }

        return $role;
    }

    /**
     * @param Role  $role
     * @param array $input
     *
     * @return \App\Models\Role
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     */
    public function update(Role $role, array $input)
    {
        if (!$role->update(Arr::except($input, ['permissions']))) {
            throw new GeneralException(trans('exceptions.backend.roles.update'));
        }

        $role->permissions()->delete();

        $permissions = isset($input['permissions']) ? $input['permissions'] : [];

        foreach ($permissions as $name) {
            $role->permissions()->create(['name' => $name]);
        }

        return $role;
    }

    /**
     * @param Role $role
     *
     * @return bool|null
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(Role $role)
    {
        if (!$role->delete()) {
            throw new GeneralException(trans('exceptions.backend.roles.delete'));
        }

        return true;
    }

    /**
     * Get only roles than current can attribute to the others
     */
    public function getAllowedRoles()
    {
        $authenticatedUser = auth()->user();

        $roles = $this->query()->with('permissions')->orderBy('order')->get();

        if ($authenticatedUser->is_super_admin) {
            return $roles;
        }

        /** @var \Illuminate\Support\Collection $permissions */
        $permissions = $authenticatedUser->getPermissions();

        $roles = $roles->filter(function (Role $role) use ($permissions) {
            foreach($role->permissions as $permission) {
                if ($permissions->search($permission, true) === false) {
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
        $buttons = $this->getEditButtonHtml('admin.role.edit', $role)
            .$this->getDeleteButtonHtml('admin.role.destroy', $role);

        return $buttons;
    }
}
