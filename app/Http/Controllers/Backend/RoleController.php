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
use Yajra\Datatables\Html\Builder;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roles;

    /**
     * Datatables Html Builder.
     *
     * @var Builder
     */
    protected $htmlBuilder;

    /**
     * Create a new controller instance.
     *
     * @param RoleRepository $roles
     * @param Builder        $htmlBuilder
     */
    public function __construct(RoleRepository $roles, Builder $htmlBuilder)
    {
        $this->roles = $roles;
        $this->htmlBuilder = $htmlBuilder;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $html = $this->htmlBuilder
            ->setTableAttribute('class', 'table table-bordered table-hover')
            ->setTableAttribute('width', '100%')
            ->parameters(['lengthChange' => false, 'searching' => false, 'order' => [[0, 'asc']]])
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => trans('validation.attributes.name')])
            ->addColumn(['data' => 'display_name', 'name' => 'display_name', 'title' => trans('validation.attributes.display_name')])
            ->addColumn(['data' => 'description', 'name' => 'description', 'title' => trans('validation.attributes.description'), 'orderable' => false])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => trans('labels.created_at')])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => trans('labels.updated_at')])
            ->addColumn(['data' => 'actions', 'name' => 'actions', 'title' => trans('labels.actions'), 'orderable' => false])
            ->ajax(['url' => route('admin.role.search'), 'type' => 'post']);

        return view('backend.role.index', compact('html'));
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
