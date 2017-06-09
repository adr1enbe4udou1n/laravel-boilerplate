<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Repositories\Contracts\RoleRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;

class RoleController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.role.index');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function search(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            /** @var EloquentEngine $collection */
            $query = Datatables::of($this->roles->get());

            return $query->editColumn('name', function (Role $role) {
                return link_to_route('admin.role.edit', $role->name, $role);
            })->addColumn('actions', function (Role $role) {
                return $this->roles->getActionButtons($role);
            })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.role.create')->withPermissions(config('permissions'));
    }

    /**
     * @param StoreRoleRequest $request
     *
     * @return mixed
     */
    public function store(StoreRoleRequest $request)
    {
        $this->roles->store($request->input());

        return redirect()->route('admin.role.index')->withFlashSuccess(trans('alerts.backend.roles.created'));
    }

    /**
     * @param Role $role
     *
     * @return mixed
     */
    public function edit(Role $role)
    {
        $role->permissions = $role->permissions->pluck('name')->toArray();

        return view('backend.role.edit')->withRole($role)->withPermissions(config('permissions'));
    }

    /**
     * @param Role              $role
     * @param UpdateRoleRequest $request
     *
     * @return mixed
     */
    public function update(Role $role, UpdateRoleRequest $request)
    {
        $this->roles->update($role, $request->input());

        return redirect()->route('admin.role.index')->withFlashSuccess(trans('alerts.backend.roles.updated'));
    }

    /**
     * @param Role    $role
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(Role $role, Request $request)
    {
        $this->roles->destroy($role);

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.roles.deleted'));
    }
}
