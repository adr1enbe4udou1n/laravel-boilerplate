<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Socialite\AbstractUser;

/**
 * Interface AccountRepository.
 */
interface AccountRepository extends BaseRepository
{
    /**
     * @param $input
     *
     * @return mixed
     */
    public function register(array $input);

    /**
     * @param Authenticatable $user
     *
     * @return mixed
     */
    public function login(Authenticatable $user);

    /**
     * @param               $provider
     * @param AbstractUser $data
     *
     * @return User
     */
    public function findOrCreateSocial($provider, AbstractUser $data);

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
     * @param $input
     *
     * @return mixed
     */
    public function update(array $input);

    /**
     * @param $oldPassword
     * @param $newPassword
     *
     * @return mixed
     */
    public function changePassword($oldPassword, $newPassword);

    /**
     * @return string
     */
    public function sendConfirmation();

    /**
     * @param $token
     *
     * @return string
     */
    public function confirmEmail($token);

    /**
     * @return mixed
     */
    public function delete();
}
