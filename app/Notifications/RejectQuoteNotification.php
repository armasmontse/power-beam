<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

use App\Models\Projects\Quote;

class RejectQuoteNotification extends CltvoNotification
{
    public $quote;
    
    public function __construct(Quote $quote)
	{
		parent::__construct();
		$this->quote = $quote;
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
                    ->view( $this->email_view )
                    ->subject(  $this->trans('subject', [
                        'name' => $this->quote->project->name
                    ]) )
                    ->greeting( $this->mail_greeting )
                    ->line($this->trans('copy', [
                        'name'   => $this->quote->project->name,
                        'status' => $this->quote->project->status->label,
                        'pm'     =>  $this->quote->project->manager->full_name,
                        'puser'  => $this->quote->project->user->full_name,
                    ]))
                    ->action( $this->trans('action'), $this->quote->project->admin_show_url)
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
