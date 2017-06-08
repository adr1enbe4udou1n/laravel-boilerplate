<?php

namespace App\Mail;

use App\Models\FormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmissionSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var FormSubmission
     */
    public $formSubmission;

    /**
     * @param \App\Models\FormSubmission $formSubmission
     *
     * @internal param $user
     */
    public function __construct(FormSubmission $formSubmission)
    {
        $this->formSubmission = $formSubmission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $lines = [];
        $data = json_decode($this->formSubmission->data);

        foreach ($data as $name => $value) {
            $lines[trans("validation.attributes.$name")] = $value;
        }

        return $this->subject(trans("mails.{$this->formSubmission->type}.subject"))
            ->markdown('vendor.notifications.email')
            ->with('level', 'success')
            ->with('introLines', $lines)
            ->with('outroLines', []);
    }
}
