<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Mcamara\LaravelLocalization\LaravelLocalization;

class AccountController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $users;

    /**
     * @var \Mcamara\LaravelLocalization\LaravelLocalization
     */
    protected $localization;

    /**
     * RegisterController constructor.
     *
     * @param UserRepository                                   $users
     * @param \Mcamara\LaravelLocalization\LaravelLocalization $localization
     * @param \Illuminate\Contracts\View\Factory               $view
     *
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
     */
    public function __construct(UserRepository $users, LaravelLocalization $localization, Factory $view)
    {
        $this->users = $users;
        $this->localization = $localization;

        $view->composer('*', function (\Illuminate\View\View $view) {
            $locales = collect($this->localization->getSupportedLocales())->map(function ($item) {
                return $item['native'];
            });

            $view->withLocales($locales)->withTimezones(\DateTimeZone::listIdentifiers());
        });
    }

    /**
     * Show profile page.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     *
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
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

        $this->users->updateProfile($request->input());

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
