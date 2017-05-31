<?php

namespace App\Repositories\Contracts;

use App\Models\Role;

/**
 * Class EloquentRoleRepository.
 */
interface RoleRepository
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function get();

    /**
     * @param $input
     *
     * @return mixed
     */
    public function store($input);

    /**
     * @param Role $role
     * @param $input
     *
     * @return mixed
     */
    public function update(Role $role, $input);

    /**
     * @param Role $role
     *
     * @return mixed
     */
    public function destroy(Role $role);

    /**
     * @param \App\Models\Role $role
     *
     * @return mixed
     */
    public function getActionButtons(Role $role);
}
