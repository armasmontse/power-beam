<?php

namespace App\Notifications\Client;

use Illuminate\Notifications\Messages\MailMessage;

use App\Notifications\CltvoNotification;

class RegisterUserNotification extends CltvoNotification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $args)
    {
        parent::__construct();
        $this->user = $args['user'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->from( $this->from_email, $this->from_name )
                    ->success()
                    ->view($this->email_view)
                    ->subject($this->trans('subject'))
                    ->greeting($this->mail_greeting)
                    ->line($this->trans('copy', [
                        'name' => $this->user->full_name
                    ]))
                    ->line( $this->mail_farawell );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
