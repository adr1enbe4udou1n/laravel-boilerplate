<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Show profile page.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('user.account');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->headers->set('referer', route('user.account').'#edit');

        $this->validate($request, [
            'name' => 'required|max:191',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $this->users->updateProfile($request->only('name', 'email'));

        return redirect()->route('user.account')
            ->withFlashSuccess(trans('labels.user.profile_updated'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $request->headers->set('referer', route('user.account').'#password');

        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $this->users->changePassword(
            $request->get('old_password'),
            $request->get('password')
        );

        return redirect()->route('user.account')
            ->withFlashSuccess(trans('labels.user.password_updated'));
    }
}
