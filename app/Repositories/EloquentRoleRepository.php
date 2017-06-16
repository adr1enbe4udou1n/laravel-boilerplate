<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Traits\HtmlActionsButtons;
use Exception;
use Illuminate\Support\Facades\DB;

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
        $role = $this->make($input);

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
        if (!$role->update($input)) {
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
