<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    public $contact;

    /**
     * Create a new message instance.
     *
     * @param $input
     */
    public function __construct($input)
    {
        $this->contact = $input;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(trans('mails.contact.subject'))
            ->view('vendor.notifications.email')
            ->text('vendor.notifications.email-plain')
            ->with('level', 'success')
            ->with('introLines', [
                trans('validation.attributes.name') => $this->contact['name'],
                trans('validation.attributes.city') => $this->contact['city'],
                trans('validation.attributes.phone') => $this->contact['phone'],
                trans('validation.attributes.email') => $this->contact['email'],
                trans('validation.attributes.message') => $this->contact['message'],
            ])
            ->with('outroLines', []);
    }
}
