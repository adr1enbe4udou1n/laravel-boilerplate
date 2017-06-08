<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * Class EloquentUserRepository.
 */
interface UserRepository
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @param array $input
     *
     * @return mixed
     */
    public function store(array $input);

    /**
     * @param User  $user
     * @param array $input
     *
     * @return mixed
     */
    public function update(User $user, array $input);

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function destroy(User $user);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDestroy(array $ids);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchEnable(array $ids);

    /**
     * @param array $ids
     *
     * @return mixed
     */
    public function batchDisable(array $ids);

    /**
     * @param $input
     *
     * @return mixed
     */
    public function updateProfile($input);

    /**
     * @param $oldPassword
     * @param $newPassword
     *
     * @return mixed
     */
    public function changePassword($oldPassword, $newPassword);

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     */
    public function loadPermissions(Authenticatable $user);

    /**
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param                                            $name
     *
     * @return mixed
     */
    public function hasPermission(Authenticatable $user, $name);

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function loginAs(User $user);

    /**
     * @return mixed
     */
    public function logoutAs();

    /**
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function getActionButtons(User $user);
}
