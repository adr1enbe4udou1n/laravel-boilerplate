<?php

namespace App\Listeners;

use App\Events\FormSubmissionCreated;
use App\Mail\FormSubmissionSend;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class FormSubmissionEventListener
{
    /**
     * @param $event
     */
    public function onCreated(FormSubmissionCreated $event)
    {
        Log::notice(trans('logs.backend.form_submissions.created', ['form_submission' => $event->formSubmission->id]));

        Mail::to([
            [
                'email' => 'admin@example.com',
                'name' => 'Admin',
            ],
        ])->send(new FormSubmissionSend($event->formSubmission));
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
