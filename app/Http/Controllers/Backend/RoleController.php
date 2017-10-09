<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends BackendController
{
    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * Create a new controller instance.
     *
     * @param RoleRepository $roles
     */
    public function __construct(RoleRepository $roles)
    {
        $this->roles = $roles;
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
            $query = DataTables::of($this->roles->select([
              'id',
              'name',
              'order',
              'created_at',
              'updated_at',
            ]));

            return $query->editColumn('name', function (Role $role) {
                return "<a href=\"/roles/{$role->id}/edit\" data-router-link>{$role->name}</a>";
            })->addColumn('actions', function (Role $role) {
                return $this->roles->getActionButtons($role);
            })->editColumn('created_at', function (Role $role) use ($request) {
                return $role->created_at->setTimezone($request->user()->timezone);
            })->editColumn('updated_at', function (Role $role) use ($request) {
                return $role->updated_at->setTimezone($request->user()->timezone);
            })
              ->rawColumns(['name', 'actions'])
              ->make(true);
        }
    }

    /**
     * @param Role $role
     *
     * @return Role
     */
    public function show(Role $role)
    {
        $role->permissions = $role->permissions()->pluck('name');

        return $role;
    }

    public function getPermissions()
    {
        return config('permissions');
    }

    /**
     * @param StoreRoleRequest $request
     *
     * @return mixed
     */
    public function store(StoreRoleRequest $request)
    {
        $this->authorize('create roles');

        $this->roles->store($request->input());

        return $this->RedirectResponse($request, trans('alerts.backend.roles.created'));
    }

    /**
     * @param Role              $role
     * @param UpdateRoleRequest $request
     *
     * @return mixed
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->authorize('edit roles');

        $this->roles->update($role, $request->input());

        return $this->RedirectResponse($request, trans('alerts.backend.roles.updated'));
    }

    /**
     * @param Role    $role
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(Role $role, Request $request)
    {
        $this->authorize('delete roles');

        $this->roles->destroy($role);

        return $this->RedirectResponse($request, trans('alerts.backend.roles.deleted'));
    }
}
