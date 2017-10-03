<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var \Yajra\DataTables\EloquentDataTable $query */
            $query = DataTables::of($this->users->select([
                'id',
                'name',
                'email',
                'active',
                'confirmed',
                'last_access_at',
                'created_at',
                'updated_at',
            ])->with('roles'));

            return $query->editColumn('name', function (User $user) {
                if ($this->users->canEdit($user)) {
                    return "<a href=\"/users/{$user->id}/edit\" data-router-link>{$user->name}</a>";
                }

                return $user->name;
            })->editColumn('confirmed', function (User $user) {
                return boolean_html_label($user->confirmed);
            })->editColumn('active', function (User $user) {
                return boolean_html_label($user->active);
            })->editColumn('roles', function (User $user) {
                return $user->formatted_roles;
            })->addColumn('actions', function (User $user) {
                return $this->users->getActionButtons($user);
            })->addColumn('last_access_at', function (User $user) use ($request) {
                return $user->last_access_at ? $user->last_access_at->setTimezone($request->user()->timezone) : null;
            })->editColumn('created_at', function (User $user) use ($request) {
                return $user->created_at->setTimezone($request->user()->timezone);
            })->editColumn('updated_at', function (User $user) use ($request) {
                return $user->updated_at->setTimezone($request->user()->timezone);
            })
                ->rawColumns(['name', 'confirmed', 'active', 'actions'])
                ->make(true);
        }
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function show(User $user)
    {
        if (!$this->users->canEdit($user)) {
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

        return $this->RedirectResponse($request, trans('alerts.backend.users.created'));
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

        return $this->RedirectResponse($request, trans('alerts.backend.users.updated'));
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

        return $this->RedirectResponse($request, trans('alerts.backend.users.deleted'));
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

                return $this->RedirectResponse($request, trans('alerts.backend.users.bulk_destroyed'));
                break;
            case 'enable':
                $this->authorize('edit users');

                $this->users->batchEnable($ids);

                return $this->RedirectResponse($request, trans('alerts.backend.users.bulk_enabled'));
                break;
            case 'disable':
                $this->authorize('edit users');

                $this->users->batchDisable($ids);

                return $this->RedirectResponse($request, trans('alerts.backend.users.bulk_disabled'));
                break;
        }

        return $this->RedirectResponse($request, trans('alerts.backend.actions.invalid'), 'error');
    }
}
