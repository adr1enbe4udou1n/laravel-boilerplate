<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExceptionOccurred extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \Exception
     */
    public $exception;

    /**
     * Create a new message instance.
     *
     * @param \Exception $exception
     */
    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('mails.alert.subject'))
            ->markdown('emails.exception-occurred')
            ->withMessage($this->exception->getMessage())
            ->withTrace($this->exception->getTraceAsString());
    }
}
