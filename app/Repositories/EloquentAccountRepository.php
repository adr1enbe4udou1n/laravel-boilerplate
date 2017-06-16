<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\User;
use App\Notifications\SendConfirmation;
use App\Repositories\Contracts\AccountRepository;
use App\Repositories\Contracts\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class EloquentAccountRepository.
 */
class EloquentAccountRepository extends EloquentBaseRepository implements AccountRepository
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * EloquentUserRepository constructor.
     *
     * @param User                                       $user
     * @param \App\Repositories\Contracts\UserRepository $users
     *
     * @internal param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     * @internal param \Illuminate\Contracts\Config\Repository $config
     */
    public function __construct(User $user, UserRepository $users)
    {
        parent::__construct($user);
        $this->users = $users;
    }

    /**
     * @param array $input
     *
     * @return \App\Models\User
     * @throws \Throwable
     * @throws \Exception
     */
    public function register(array $input)
    {
        $user = $this->users->store(Arr::only($input, ['name', 'email', 'password']));

        $this->sendConfirmationToUser($user);
        return $user;
    }

    /**
     * @param Authenticatable $user
     *
     * @return \App\Models\User
     * @throws \App\Exceptions\GeneralException
     */
    public function login(Authenticatable $user)
    {
        /** @var User $user */
        $user = $this->query()->find($user->id);

        $user->last_access_at = Carbon::now();

        if (!$user->save()) {
            throw new GeneralException(trans('exceptions.backend.users.update'));
        }

        session(['permissions' => $user->getPermissions()]);

        return $user;
    }

    /**
     * @param $input
     *
     * @return mixed
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function update(array $input)
    {
        $user = auth()->user();

        /** @var User $user */
        $user = $this->query()->find($user->id);

        $user->fill(Arr::only($input, ['name', 'email', 'locale', 'timezone']));

        if ($user->isDirty('email')) {
            // Emails have to be unique
            if ($this->query()->whereEmail($user->email)->exists()) {
                throw new GeneralException(trans('exceptions.frontend.user.email_taken'));
            }

            $user->confirmed = false;
            $this->sendConfirmationToUser($user);
        }

        return $user->save();
    }

    /**
     * @param $oldPassword
     * @param $newPassword
     *
     * @return mixed
     *
     * @throws \App\Exceptions\GeneralException
     */
    public function changePassword($oldPassword, $newPassword)
    {
        $user = auth()->user();

        /** @var User $user */
        $user = $this->query()->find($user->id);

        if (Hash::check($oldPassword, $user->password)) {
            $user->password = bcrypt($newPassword);

            return $user->save();
        }

        throw new GeneralException(trans('exceptions.frontend.user.password_mismatch'));
    }

    /**
     * Send mail confirmation
     */
    public function sendConfirmation()
    {
        $user = auth()->user();

        /** @var User $user */
        $user = $this->query()->find($user->id);

        $this->sendConfirmationToUser($user);
    }

    /**
     * @param \App\Models\User $user
     */
    private function sendConfirmationToUser(User $user)
    {
        $user->confirmation_token = Str::random(60);
        $user->save();

        $user->notify(new SendConfirmation($user->confirmation_token));
    }

    /**
     * Send mail confirmation
     *
     * @param $token
     *
     * @return string|void
     */
    public function confirmEmail($token)
    {
        $user = auth()->user();

        /** @var User $user */
        $user = $this->query()->find($user->id);

        if ($user->confirmation_token === $token) {
            $user->confirmed = true;
            $user->save();
        }
    }

    /**
     * @return mixed
     * @throws \App\Exceptions\GeneralException|Exception
     */
    public function delete()
    {
        $user = auth()->user();

        /** @var User $user */
        $user = $this->query()->find($user->id);

        if ($user->is_super_admin) {
            throw new GeneralException(trans('exceptions.backend.users.first_user_cannot_be_destroyed'));
        }

        if (!$user->delete()) {
            throw new GeneralException(trans('exceptions.frontend.user.delete_account'));
        }

        return true;
    }
}
