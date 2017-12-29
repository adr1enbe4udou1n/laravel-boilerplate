<?php

namespace App\Repositories\Contracts;

use App\Models\Role;

/**
 * Interface RoleRepository.
 */
interface RoleRepository extends BaseRepository
{
    /**
     * @param array $input
     *
     * @return mixed|Role
     */
    public function store(array $input);

    /**
     * @param Role  $role
     * @param array $input
     *
     * @return mixed|Role
     */
    public function update(Role $role, array $input);

    /**
     * @param Role $role
     *
     * @return mixed
     */
    public function destroy(Role $role);

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getAllowedRoles();
}
