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

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.user.index');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
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
            })->make(true);
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

        if (! $user) {
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

        if (! $user) {
            abort(404);
        }
        $this->users->update($user, $request->input());

        return back()->withFlashSuccess(trans('alerts.backend.users.updated'));
    }
}
