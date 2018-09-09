<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\RequestSearchQuery;
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function search(Request $request)
    {
        $requestSearchQuery = new RequestSearchQuery($request, $this->users->query(), [
            'name',
            'email',
        ]);

        if ($request->get('exportData')) {
            return $requestSearchQuery->export([
                'name',
                'email',
                'active',
                'last_access_at',
                'created_at',
                'updated_at',
            ],
                [
                    __('validation.attributes.name'),
                    __('validation.attributes.email'),
                    __('validation.attributes.active'),
                    __('labels.last_access_at'),
                    __('labels.created_at'),
                    __('labels.updated_at'),
                ],
                'users');
        }

        return $requestSearchQuery->result([
            'id',
            'name',
            'email',
            'active',
            'last_access_at',
            'created_at',
            'updated_at',
        ]);
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

        return $this->redirectResponse($request, __('alerts.backend.users.created'));
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

        return $this->redirectResponse($request, __('alerts.backend.users.updated'));
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

        return $this->redirectResponse($request, __('alerts.backend.users.deleted'));
    }

    /**
     * @param User $user
     *
     * @return mixed
     */
    public function impersonate(User $user)
    {
        $this->authorize('impersonate users');

        return $this->users->impersonate($user);
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

                return $this->redirectResponse($request, __('alerts.backend.users.bulk_destroyed'));
                break;
            case 'enable':
                $this->authorize('edit users');

                $this->users->batchEnable($ids);

                return $this->redirectResponse($request, __('alerts.backend.users.bulk_enabled'));
                break;
            case 'disable':
                $this->authorize('edit users');

                $this->users->batchDisable($ids);

                return $this->redirectResponse($request, __('alerts.backend.users.bulk_disabled'));
                break;
        }

        return $this->redirectResponse($request, __('alerts.backend.actions.invalid'), 'error');
    }

    public function activeToggle(User $user)
    {
        $this->authorize('edit users');
        $user->update(['active' => ! $user->active]);
    }
}
