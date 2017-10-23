<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Mcamara\LaravelLocalization\LaravelLocalization;

class SetLocale
{
    /**
     * @var \Mcamara\LaravelLocalization\LaravelLocalization
     */
    protected $localization;

    public function __construct(LaravelLocalization $localization)
    {
        $this->localization = $localization;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @throws \Mcamara\LaravelLocalization\Exceptions\SupportedLocalesNotDefined
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $currentLocale = $this->localization->getCurrentLocale();
        $supportedLocale = $this->localization->getSupportedLocales()[$currentLocale];

        /*
         * setLocale for php. Enables localized dates, format numbers, etc.
         */
        setlocale(LC_ALL,
            $supportedLocale['regional'],
            "{$supportedLocale['regional']}.utf-8",
            "{$supportedLocale['regional']}.iso-8859-1",
            $supportedLocale['locale_win']
        );

        /*
         * setLocale to use Carbon source locales. Enables diffForHumans() localized
         */
        Carbon::setLocale($currentLocale);
        Carbon::setUtf8(true);

        /*
         * Set Captcha locale
         */
        app('config')->set('no-captcha.lang', $currentLocale);

        return $next($request);
    }
}
