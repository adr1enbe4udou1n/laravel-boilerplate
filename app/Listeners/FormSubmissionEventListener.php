<?php

namespace App\Listeners;

use App\Mail\Contact;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Events\FormSubmissionCreated;
use App\Repositories\Contracts\FormSettingRepository;

class FormSubmissionEventListener
{
    /**
     * @var FormSettingRepository
     */
    protected $formSettings;

    /**
     * Create a new controller instance.
     *
     * @param \App\Repositories\Contracts\FormSettingRepository $formSettings
     */
    public function __construct(FormSettingRepository $formSettings)
    {
        $this->formSettings = $formSettings;
    }

    /**
     * @param $event
     */
    public function onCreated(FormSubmissionCreated $event)
    {
        Log::notice(__('logs.backend.form_submissions.created',
            ['form_submission' => $event->formSubmission->id]));

        $formSetting = $this->formSettings->find($event->formSubmission->type);

        if ($formSetting && ! empty($formSetting->recipients)) {
            Mail::to($formSetting->array_recipients)
                ->send(new Contact($event->formSubmission));
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            FormSubmissionCreated::class,
            'App\Listeners\FormSubmissionEventListener@onCreated'
        );
    }
}
