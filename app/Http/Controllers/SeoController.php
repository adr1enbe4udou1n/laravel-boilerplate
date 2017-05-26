<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;

class SeoController extends Controller
{
    public function robots()
    {
        $lines = [
            'User-agent: *',
            'Disallow:',
            'Sitemap: '.url('/').'/sitemap.xml',
        ];

        return Response::make(implode(PHP_EOL, $lines), 200, ['Content-Type' => 'text/plain']);
    }

    public function sitemap()
    {
        $sitemap = app('sitemap');

        $sitemap->add(route('home'), Carbon::now(), '1.0', 'daily');
        $sitemap->add(route('about'), Carbon::now(), '1.0', 'daily');
        $sitemap->add(route('contact'), Carbon::now(), '1.0', 'daily');
        $sitemap->add(route('legal-mentions'), Carbon::now(), '1.0', 'daily');

        return $sitemap->render('xml');
    }
}
