<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\AbstractUser;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use App\Repositories\Contracts\AccountRepository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    protected $maxAttempts = 5;

    protected $decayMinutes = 10;

    protected $supportedProviders = [
        'bitbucket',
        'facebook',
        'google',
        'github',
        'linkedin',
        'twitter',
    ];

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
        $this->middleware('guest')->except('logout', 'adminLogout');

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
            ->withIsLocked($this->hasTooManyLoginAttempts($request));
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

                $socialiteLinks[] = "<a href=\"{$route}\" class=\"btn btn-default btn-{$name}\"><font-awesome-icon :icon=\"['fab', '{$name}']\"></font-awesome-icon> {$icon}</a>";
            }
        }

        foreach ($socialiteLinks as $socialiteLink) {
            $socialiteHtml .= ('' !== $socialiteHtml ? '&nbsp;' : '')
                .$socialiteLink;
        }

        return $socialiteHtml;
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
            'password'        => 'required|string',
        ];

        if ($this->hasTooManyLoginAttempts($request)) {
            $rules['g-recaptcha-response'] = ['required', new CaptchaRule()];
        }

        $this->validate($request, $rules);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->clearLoginAttempts($request);
        }
    }

    private function flushSession(Request $request, $redirectTo = 'home')
    {
        if ($admin_id = session()->get('admin_user_id')) {
            // Impersonate mode, back to original User
            session()->forget('admin_user_id');
            session()->forget('admin_user_name');
            session()->forget('temp_user_id');

            auth()->loginUsingId((int) $admin_id);

            return redirect()->route('admin.home');
        }

        // Normal logout
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route($redirectTo);
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
        return $this->flushSession($request);
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
        return $this->flushSession($request, 'admin.login');
    }

    protected function redirectTo()
    {
        return home_route();
    }

    /**
     * @param                          $provider
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToProvider($provider, Request $request)
    {
        if (! \in_array($provider, $this->supportedProviders, true)) {
            return redirect()->route('home')->withFlashError(__('auth.socialite.unacceptable', ['provider' => $provider]));
        }

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

        if (! $user->active) {
            return redirect()->route('login')->withFlashError(__('labels.auth.disabled'));
        }

        auth()->login($user, true);

        return redirect()->intended(home_route());
    }
}
