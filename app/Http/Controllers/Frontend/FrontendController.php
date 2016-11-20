<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use View;

class FrontendController extends Controller
{
    public function __construct(Request $request)
    {
        if ($route = $request->route()) {
            $config = config('meta');

            if (isset($config[$route->getName()])) {
                $meta = $config[$route->getName()];
            } else {
                $meta = $config['default'];

                if (!isset($meta['title'])) {
                    $meta['title'] = $config['default']['title'];
                }
            }

            View::share('title', $meta['title']);
            View::share('description', $meta['description']);
        }
    }

    public function index()
    {
        return view('frontend.home');
    }
}
