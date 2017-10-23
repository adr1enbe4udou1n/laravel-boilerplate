<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SendConfirmation extends Notification
{
    use Queueable;

    /**
     * The mail confirmation token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'token' => $this->token,
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(__('mails.email_confirmation.subject'))
            ->line(__('mails.email_confirmation.intro'))
            ->action(__('mails.email_confirmation.action'), route('user.email.confirm', $this->token))
            ->line(__('mails.email_confirmation.outro'));
    }
}
