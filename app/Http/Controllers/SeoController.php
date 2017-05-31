<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SeoController extends Controller
{
    public function robots()
    {
        $lines = [
            'User-agent: *',
            'Disallow:',
            'Sitemap: '.url('/').'/sitemap.xml',
        ];

        return Response::make(implode(PHP_EOL, $lines), 200,
            ['Content-Type' => 'text/plain']);
    }

    public function sitemap()
    {
        $sitemap = app('sitemap');

        $sitemap->addItem([
            'loc' => route('home'),
            'lastmod' => Carbon::now(),
            'priority' => '1.0',
            'freq' => 'daily',
            'translations' => $this->getTranslations('home'),
        ]);

        $sitemap->addItem([
            'loc' => route('about'),
            'lastmod' => Carbon::now(),
            'priority' => '1.0',
            'freq' => 'daily',
            'translations' => $this->getTranslations('about'),
        ]);

        $sitemap->addItem([
            'loc' => route('contact'),
            'lastmod' => Carbon::now(),
            'priority' => '1.0',
            'freq' => 'daily',
            'translations' => $this->getTranslations('contact'),
        ]);

        $sitemap->addItem([
            'loc' => route('legal-mentions'),
            'lastmod' => Carbon::now(),
            'priority' => '1.0',
            'freq' => 'daily',
            'translations' => $this->getTranslations('legal-mentions'),
        ]);

        return $sitemap->render('xml');
    }

    private function getTranslations($routeName)
    {
        $translations = [];

        $defaultLocale = LaravelLocalization::getDefaultLocale();

        $supportedLocales = array_filter(LaravelLocalization::getSupportedLocales(), function ($localCode) use ($defaultLocale) {
            return $localCode !== $defaultLocale;
        }, ARRAY_FILTER_USE_KEY);

        foreach ($supportedLocales as $localeCode => $properties) {
            $translations[] = [
                'language' => $localeCode,
                'url' => LaravelLocalization::getLocalizedURL($localeCode, route($routeName)),
            ];
        }

        return $translations;
    }
}
