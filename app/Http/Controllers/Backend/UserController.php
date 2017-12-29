<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;

class UserController extends BackendController
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository                             $users
     * @param \App\Repositories\Contracts\RoleRepository $roles
     */
    public function __construct(UserRepository $users, RoleRepository $roles)
    {
        $this->users = $users;
        $this->roles = $roles;
    }

    public function getActiveUserCounter()
    {
        return $this->users->query()->whereActive(true)->count();
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $query = $this->users->query()->with('roles');

            if ($column = $request->get('column')) {
                $query->orderBy($request->get('column'), $request->get('direction') ?? 'asc');
            }

            return $query->paginate($request->get('perPage'), [
                'id',
                'name',
                'email',
                'active',
                'confirmed',
                'last_access_at',
                'created_at',
                'updated_at',
            ]);
        }
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function show(User $user)
    {
        if (! $user->can_edit) {
            // Only Super admin can access himself
            abort(403);
        }

        $user->roles = $user->roles()->pluck('id');

        return $user;
    }

    public function getRoles()
    {
        return $this->roles->getAllowedRoles();
    }

    /**
     * @param StoreUserRequest $request
     *
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        $this->authorize('create users');

        $this->users->store($request->input());

        return $this->RedirectResponse($request, __('alerts.backend.users.created'));
    }

    /**
     * @param User              $user
     * @param UpdateUserRequest $request
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     *
     * @return mixed
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $this->authorize('edit users');

        $this->users->update($user, $request->input());

        return $this->RedirectResponse($request, __('alerts.backend.users.updated'));
    }

    /**
     * @param User    $user
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(User $user, Request $request)
    {
        $this->authorize('delete users');

        $this->users->destroy($user);

        return $this->RedirectResponse($request, __('alerts.backend.users.deleted'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function batchAction(Request $request)
    {
        $action = $request->get('action');
        $ids = $request->get('ids');

        switch ($action) {
            case 'destroy':
                $this->authorize('delete users');

                $this->users->batchDestroy($ids);

                return $this->RedirectResponse($request, __('alerts.backend.users.bulk_destroyed'));
                break;
            case 'enable':
                $this->authorize('edit users');

                $this->users->batchEnable($ids);

                return $this->RedirectResponse($request, __('alerts.backend.users.bulk_enabled'));
                break;
            case 'disable':
                $this->authorize('edit users');

                $this->users->batchDisable($ids);

                return $this->RedirectResponse($request, __('alerts.backend.users.bulk_disabled'));
                break;
        }

        return $this->RedirectResponse($request, __('alerts.backend.actions.invalid'), 'error');
    }
}
