<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Arcanedev\NoCaptcha\Rules\CaptchaRule;
use App\Repositories\Contracts\FormSettingRepository;
use App\Repositories\Contracts\FormSubmissionRepository;

class PagesController extends FrontendController
{
    /**
     * @var FormSubmissionRepository
     */
    protected $formSubmissions;

    /**
     * @var FormSettingRepository
     */
    protected $formSettings;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\Contracts\FormSubmissionRepository $formSubmissions
     * @param \App\Repositories\Contracts\FormSettingRepository    $formSettings
     */
    public function __construct(FormSubmissionRepository $formSubmissions, FormSettingRepository $formSettings)
    {
        parent::__construct();

        $this->formSubmissions = $formSubmissions;
        $this->formSettings = $formSettings;
    }

    public function about()
    {
        return view('frontend.pages.about')->withFlashMessage('Hey ! I\'m a flash message !');
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'name'                 => 'required',
                'email'                => 'required|email',
                'message'              => 'required',
                'g-recaptcha-response' => ['required', new CaptchaRule()],
            ]);

            $this->formSubmissions->store('contact', $request->input());

            return redirect(route('contact-sent'));
        }

        return view('frontend.pages.contact');
    }

    public function contactSent()
    {
        $message = null;

        if ($formSetting = $this->formSettings->find('contact')) {
            $message = $formSetting->html_message;
        }

        return view('frontend.pages.contact-sent', compact('message'));
    }

    public function legalMentions()
    {
        return view('frontend.pages.legal-mentions');
    }
}
