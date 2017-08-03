<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;

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
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Exception
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var EloquentEngine $query */
            $query = Datatables::of($this->users->select([
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
                    return link_to("#/user/{$user->id}/edit", $user->name);
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
                ->rawColumns(['confirmed', 'active', 'actions'])
                ->make(true);
        }
    }

    /**
     * @param User $user
     *
     * @return User
     */
    public function get(User $user)
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
        $this->users->store($request->input());

        return redirect()->route('admin.user.index')->withFlashSuccess(trans('alerts.backend.users.created'));
    }

    /**
     * @param User              $user
     * @param UpdateUserRequest $request
     *
     * @return mixed
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        $this->users->update($user, $request->input());

        return redirect()->route('admin.user.index')->withFlashSuccess(trans('alerts.backend.users.updated'));
    }

    /**
     * @param User    $user
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(User $user, Request $request)
    {
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
                $this->users->batchDestroy($ids);

                return $this->RedirectResponse($request, trans('alerts.backend.users.bulk_destroyed'));
                break;
            case 'enable':
                $this->users->batchEnable($ids);

                return $this->RedirectResponse($request, trans('alerts.backend.users.bulk_enabled'));
                break;
            case 'disable':
                $this->users->batchDisable($ids);

                return $this->RedirectResponse($request, trans('alerts.backend.users.bulk_disabled'));
                break;
        }

        return $this->RedirectResponse($request, trans('alerts.backend.actions.invalid'), 'error');
    }
}
