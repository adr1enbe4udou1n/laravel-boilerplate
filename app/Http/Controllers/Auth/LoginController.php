<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Contracts\AccountRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\AbstractUser;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * @var \App\Repositories\Contracts\AccountRepository
     */
    protected $account;

    /**
     * RegisterController constructor.
     *
     * @param AccountRepository $account
     */
    public function __construct(AccountRepository $account)
    {
        $this->middleware('guest')->except('logout', 'adminLogout', 'loginAs', 'logoutAs');

        $this->account = $account;
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    protected function credentials(Request $request)
    {
        return $request->only($this->username(), 'password') + ['active' => 1];
    }

    /**
     * Show the application's login form.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        return view('auth.login')
            ->withIsLocked($this->hasTooManyLoginAttempts($request))
            ->withSocialiteLinks(self::getSocialLinks());
    }

    /**
     * Show the application's login form.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function showAdminLoginForm(Request $request)
    {
        return view('auth.admin.login')
            ->withIsLocked($this->hasTooManyLoginAttempts($request))
            ->withSocialiteLinks(self::getSocialLinks());
    }

    /**
     * Generates social login links based on what is enabled.
     *
     * @return string
     */
    private static function getSocialLinks()
    {
        $socialiteLinks = [];
        $socialiteHtml = '';

        foreach (config('services') as $name => $service) {
            if (isset($service['client_id'])) {
                $route = route('social.login', $name);
                $icon = ucfirst($name);

                $socialiteLinks[] = "<a href=\"{$route}\" class=\"btn btn-default btn-{$name}\"><i class=\"fa fa-{$name} fa-lg\"></i> {$icon}</a>";
            }
        }

        foreach ($socialiteLinks as $socialiteLink) {
            $socialiteHtml .= ('' !== $socialiteHtml ? '&nbsp;' : '')
                .$socialiteLink;
        }

        return $socialiteHtml;
    }

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), 3, 10
        );
    }

    /**
     * Get the throttle key for the given request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->ip());
    }

    /**
     * Validate the user login request.
     *
     * @param \Illuminate\Http\Request $request
     */
    protected function validateLogin(Request $request)
    {
        $rules = [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ];

        if ($this->hasTooManyLoginAttempts($request)) {
            $rules['g-recaptcha-response'] = 'required|captcha';
        }

        $this->validate($request, $rules);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->clearLoginAttempts($request);
        }
    }

    private function flushSession(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @throws \RuntimeException
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->flushSession($request);

        return redirect()->route('home');
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     *
     * @throws \RuntimeException
     *
     * @return \Illuminate\Http\Response
     */
    public function adminLogout(Request $request)
    {
        $this->flushSession($request);

        return redirect()->route('admin.login');
    }

    /**
     * @param User $user
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAs(User $user)
    {
        return $this->account->loginAs($user);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutAs()
    {
        return $this->account->logoutAs();
    }

    protected function redirectTo()
    {
        return home_route();
    }

    /**
     * @param                          $provider
     * @param \Illuminate\Http\Request $request
     */
    public function redirectToProvider($provider, Request $request)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param                          $provider
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider, Request $request)
    {
        /** @var AbstractUser $user */
        $data = Socialite::driver($provider)->user();

        try {
            /** @var User $user */
            $user = $this->account->findOrCreateSocial($provider, $data);
        } catch (GeneralException $e) {
            return redirect()->route('login')->withFlashError($e->getMessage());
        }

        if (!$user->active) {
            return redirect()->route('login')->withFlashError(trans('labels.auth.disabled'));
        }

        auth()->login($user, true);

        return redirect()->intended(home_route());
    }
}
