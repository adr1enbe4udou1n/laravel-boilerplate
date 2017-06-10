<?php

namespace App\Repositories\Contracts;

use App\Models\Role;

/**
 * Class EloquentRoleRepository.
 */
interface RoleRepository extends BaseRepository
{
    /**
     * @return \Illuminate\Database\Query\Builder
     */
    public function get();

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input);

    /**
     * @param Role  $role
     * @param array $input
     *
     * @return mixed
     */
    public function update(Role $role, array $input);

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
