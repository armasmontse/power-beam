<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Projects\Project;

class ProjectManagerAssignedNotification extends CltvoNotification
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
							->subject($this->trans('subject', [
								'manager_name' => $this->project->manager->full_name
							]))
							->greeting($this->mail_greeting)
							->line($this->trans('copy', [
								'manager_name' => $this->project->manager->full_name,
								'manager_email' => $this->project->manager->email,
							]))
							->action($this->trans('action'), $this->project->show_url)
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
