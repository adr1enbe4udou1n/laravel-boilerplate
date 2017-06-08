<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\FormSubmissionRepository;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * @var FormSubmissionRepository
     */
    protected $formSubmissions;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\Contracts\FormSubmissionRepository $formSubmissions
     */
    public function __construct(FormSubmissionRepository $formSubmissions)
    {
        $this->formSubmissions = $formSubmissions;
    }

    public function index()
    {
        return view('frontend.home');
    }

    public function about()
    {
        return view('frontend.pages.about')->withFlashMessage('Hey ! I\'m a flash message !');
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
                'g-recaptcha-response' => 'required|captcha',
            ]);

            $this->formSubmissions->store('contact', $request->input());

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
