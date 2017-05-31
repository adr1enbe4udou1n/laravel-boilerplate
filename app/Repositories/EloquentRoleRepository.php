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
class EloquentRoleRepository implements RoleRepository
{
    use HtmlActionsButtons;

    /**
     * @return mixed
     */
    public function get()
    {
        return Role::select(['id', 'name', 'display_name', 'description', 'created_at', 'updated_at'])->orderBy('name');
    }

    /**
     * @param  $input
     *
     * @return \App\Models\Role
     *
     * @throws \Exception|\Throwable
     */
    public function store($input)
    {
        $role = new Role($input);

        DB::transaction(function () use ($role) {
            if ($role->save()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.roles.create_error'));
        });

        $permissions = isset($input['permissions']) ? $input['permissions'] : [];
        foreach($permissions as $name) {
            $role->permissions()->create(['name' => $name]);
        }

        return $role;
    }

    /**
     * @param Role $role
     * @param $input
     *
     * @return \App\Models\Role
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     */
    public function update(Role $role, $input)
    {
        DB::transaction(function () use ($role, $input) {
            if ($role->update($input)) {
                $role->save();

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.roles.update_error'));
        });

        $role->permissions()->delete();

        $permissions = isset($input['permissions']) ? $input['permissions'] : [];
        foreach($permissions as $name) {
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
        DB::transaction(function () use ($role) {
            if ($role->delete()) {
                return true;
            }

            throw new GeneralException(trans('exceptions.backend.roles.delete_error'));
        });

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
