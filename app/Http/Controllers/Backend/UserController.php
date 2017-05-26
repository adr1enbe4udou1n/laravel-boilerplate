<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Yajra\Datatables\Engines\EloquentEngine;
use Yajra\Datatables\Html\Builder;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * Datatables Html Builder.
     *
     * @var Builder
     */
    protected $htmlBuilder;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $users
     * @param Builder        $htmlBuilder
     */
    public function __construct(UserRepository $users, Builder $htmlBuilder)
    {
        $this->users = $users;
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
            ->parameters(['lengthChange' => false, 'searching' => false, 'order' => [[5, 'desc']]])
            ->addColumn(['data' => 'name', 'name' => 'name', 'title' => trans('validation.attributes.name')])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => trans('validation.attributes.email')])
            ->addColumn(['data' => 'active', 'name' => 'active', 'title' => trans('validation.attributes.active'), 'orderable' => false])
            ->addColumn(['data' => 'role', 'name' => 'role', 'title' => trans('validation.attributes.role'), 'orderable' => false])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => trans('labels.created_at')])
            ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => trans('labels.updated_at')])
            ->addColumn(['data' => 'actions', 'name' => 'actions', 'title' => trans('labels.actions'), 'orderable' => false])
            ->ajax(['url' => route('admin.user.search'), 'type' => 'post']);

        return view('backend.user.index', compact('html'));
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
            $query = Datatables::of($this->users->get());

            return $query->editColumn('email', function (User $user) {
                return link_to_route('admin.user.edit', $user->email, $user);
            })->editColumn('active', function (User $user) {
                return $user->activated_label;
            })->editColumn('role', function (User $user) {
                return $user->role_label;
            })->addColumn('actions', function (User $user) {
                return $user->action_buttons;
            })
                ->rawColumns(['active', 'actions'])
                ->make(true);
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        return view('backend.user.create');
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
     * @param User $user
     *
     * @return mixed
     */
    public function edit(User $user)
    {
        return view('backend.user.edit')->withUser($user);
    }

    /**
     * @param User              $user
     * @param UpdateUserRequest $request
     *
     * @return mixed
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

        return redirect()->back()->withFlashSuccess(trans('alerts.backend.users.deleted'));
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAs(User $user)
    {
        return $this->users->loginAs($user);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        return $this->users->logoutAs();
    }

    /**
     * @return mixed
     */
    public function profileEdit()
    {
        $user = User::find(auth()->user()->id);

        if (!$user) {
            abort(404);
        }

        return view('backend.user.profile')->withUser($user);
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     */
    public function profileUpdate(UpdateProfileRequest $request)
    {
        $user = User::find(auth()->user()->id);

        if (!$user) {
            abort(404);
        }
        $this->users->update($user, $request->input());

        return back()->withFlashSuccess(trans('alerts.backend.users.updated'));
    }
}
