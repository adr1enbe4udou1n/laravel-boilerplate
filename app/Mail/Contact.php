<?php

namespace App\Mail;

use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\FormSubmission;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
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
        $data = (array) json_decode($this->formSubmission->data);

        return $this->subject(__("mails.{$this->formSubmission->type}.subject"))
            ->markdown('emails.contact')
            ->withData(Arr::except($data, 'message'))
            ->withMessage($data['message']);
    }
}
