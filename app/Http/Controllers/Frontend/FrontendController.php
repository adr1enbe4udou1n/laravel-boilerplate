<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactSend;
use Illuminate\Http\Request;
use Mail;
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

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required',
                'city' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'message' => 'required',
                'g-recaptcha-response' => 'required|captcha',
            ]);

            Mail::send(new ContactSend($request->input()));

            return redirect(route('contact-sent'));
        }

        return view('frontend.pages.contact');
    }

    public function contactSent()
    {
        return view('frontend.pages.contact-sent');
    }

    public function legalMentions()
    {
        return view('frontend.pages.legal-mentions');
    }
}
