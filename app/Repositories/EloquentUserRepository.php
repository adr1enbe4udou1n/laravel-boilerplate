<?php

namespace App\Repositories;

use App\Events\UserCreated;
use App\Events\UserDeleted;
use App\Events\UserUpdated;
use App\Exceptions\GeneralException;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;

/**
 * Class EloquentUserRepository.
 */
class EloquentUserRepository implements UserRepository
{
    /**
     * @return mixed
     */
    public function get()
    {
        return User::select(['id', 'name', 'email', 'active', 'role', 'created_at', 'updated_at']);
    }

    /**
     * @param  $input
     *
     * @return bool
     *
     * @throws \Exception|\Throwable
     */
    public function store($input)
    {
        $user = new User($input);
        $user->password = bcrypt($input['password']);

        DB::transaction(function () use ($user) {
            if ($user->save()) {
                event(new UserCreated($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.users.create_error'));
        });
    }

    /**
     * @param User $user
     * @param $input
     *
     * @return bool
     *
     * @throws Exception
     * @throws \Exception|\Throwable
     */
    public function update(User $user, $input)
    {
        DB::transaction(function () use ($user, $input) {
            if ($user->update($input)) {
                if (isset($input['password']) && !empty($input['password'])) {
                    $user->password = bcrypt($input['password']);
                }
                $user->save();

                event(new UserUpdated($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.users.update_error'));
        });
    }

    /**
     * @param User $user
     *
     * @return bool|null
     *
     * @throws \Exception|\Throwable
     */
    public function destroy(User $user)
    {
        DB::transaction(function () use ($user) {
            if ($user->delete()) {
                event(new UserDeleted($user));

                return true;
            }

            throw new GeneralException(trans('exceptions.backend.users.delete_error'));
        });
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws Exception
     */
    public function loginAs(User $user)
    {
        if (auth()->id() === $user->id || session()->get('admin_user_id') === $user->id) {
            return redirect()->route('admin.dashboard');
        }

        $this->flushTempSession();

        session(['admin_user_id' => auth()->id()]);
        session(['admin_user_name' => auth()->user()->name]);
        session(['temp_user_id' => $user->id]);

        //Login user
        auth()->loginUsingId($user->id);

        return redirect()->route('admin.dashboard');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        if (!auth()->check()) {
            return redirect()->route('auth.login');
        }

        if ($admin_id = session()->get('admin_user_id')) {
            $this->flushTempSession();
            auth()->loginUsingId((int) $admin_id);
        }

        return redirect()->route('admin.dashboard');
    }

    /**
     * Remove old session variables from admin logging in as user.
     */
    private function flushTempSession()
    {
        session()->forget('admin_user_id');
        session()->forget('admin_user_name');
        session()->forget('temp_user_id');
    }
}
