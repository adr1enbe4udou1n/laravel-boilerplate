<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\Contracts\FormSettingRepository;
use App\Repositories\Contracts\FormSubmissionRepository;
use Illuminate\Http\Request;

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
        throw new \Exception('fuck');
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
        $formSetting = $this->formSettings->find('contact');

        return view('frontend.pages.contact-sent')->withMessage($formSetting->html_message);
    }

    public function legalMentions()
    {
        return view('frontend.pages.legal-mentions');
    }
}
