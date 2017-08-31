<?php

namespace App\Repositories\Contracts;

use App\Models\User;

/**
 * Interface UserRepository.
 */
interface UserRepository extends BaseRepository
{
    /**
     * @param string $slug
     *
     * @return User
     */
    public function findBySlug($slug);

    /**
     * @param array $input
     * @param bool  $confirmed
     *
     * @return mixed
     */
    public function store(array $input, $confirmed = false);

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
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function canEdit(User $user);

    /**
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function canDelete(User $user);

    /**
     * @param \App\Models\User $user
     *
     * @return mixed
     */
    public function getActionButtons(User $user);
}
