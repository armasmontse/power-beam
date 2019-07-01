<?php

namespace App\Notifications\User\Projects;

use App\Notifications\CltvoNotification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Projects\Project;

class ProjectReviewingNotification extends CltvoNotification
{
    public $project;
    
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
                    ->from( $this->from_email, $this->from_name )
                    ->view( $this->email_view )
                    ->subject(  $this->trans('subject', [
                        'name' => $this->project->name
                    ]) )
                    ->greeting( $this->mail_greeting )
                    ->line($this->trans('copy', [
                        'name' => $this->project->name,
                        'status' => $this->project->status->label,
                        'pm'    =>  $this->project->manager->full_name,
                        'puser' => $this->project->user->full_name,
                    ]))
                    ->action( $this->trans('action'), $this->project->admin_show_url)
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
