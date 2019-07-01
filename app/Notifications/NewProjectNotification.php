<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Projects\Project;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewProjectNotification extends CltvoNotification
{
	use Queueable;
	
	public $project;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        parent::__construct();
        $this->project = $project;
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
					->from($this->from_email, $this->from_name)
					->view($this->email_view)
					->subject($this->trans('subject'))
					->greeting($this->mail_greeting)
					->line($this->trans('copy', [
						'project_name' => $this->project->name,
					]))
					->action($this->trans('action'), $this->project->admin_show_url)
					->line($this->mail_farawell);
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
