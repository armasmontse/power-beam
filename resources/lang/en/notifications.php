<?php

return [
	'user' =>[
		'update_password'    => [
			'subject'   => 'Your password has changed',
			'copy'      => 'Recently your password was changed. If it was you ignore this message on the contrary call techincal support',
		],

		'update_mail'    => [
			'subject'   => 'Your email has changed',
			'copy'      => 'Recently your email was changed. If it was you ignore this message on the contrary call techincal support',
		],

		'projects' => [
			'project' => [
				'subject' => 'The status of your project has changed.',
				'action' => 'Go to project',
				'copy' => 'The status of your project ":Name" has changed to: :Status'
			],
			'project_reviewing' => [
				'subject' => 'Project :Name info is now complete.',
				'copy' => 'The information of this project ":Name" has been completed',
				'action' => 'Go to project'
			]
		]
	],

	'admin' => [
		'users'	=> [
			'activation_account' => [
				'subject'   => 'El Cultivo register',
				'action'    => 'Activate account',
			],
		]
	],

	'general'=> [
		'success'			=> 'Hello!',
		'error'				=> 'Whoops!',
		'salutation'		=> 'Greetings',
		'button_problems'	=> 'If you have problems clicking the ":button", copy and paste the following URL in your browser.',
		'rights_reserved'	=> 'All rights reserved',

	],

	'client'=> [
		'reset_password' => [
			'subject'   => 'Restore password',
			'copy'      => 'We recently noticed that you have lost your password, to restore click on the button',
			'action'    => 'Restore password',
		],
		
		'contact' => [
			'subject'   => 'Contact information: :email (:name)',
			'copy'      => ':name with mail :email leave the following message <br/> :message',
		],

		'thanks_for_contact' => [
			'subject'   => 'Contact confirmation',
			'copy'      => 'Thank you for your message. We will contact you soon.',
		],

		'register_user' => [
			'subject'   => 'Thanks for registering',
			'copy'      => 'This is a confirmation email of your registration. Thanks for registering!',
		],
	],

	'reject_quote' => [
		'subject'   => 'Project: :name - Quote rejected',
		'copy'      => ':Puser rejected the quote from project :name',
		'action'    => 'Go to project',
	],

	'accept_quote' => [
		'subject'   => 'Project: :name - Quote accepted',
		'copy'      => ':Puser accepted the quote from project :name',
		'action'    => 'Go to project',
	],

	'project_assigned' => [
		'subject'   => 'A project has been assigned to you.',
		'copy'      => 'The project :Project_name has been assigned to you. Please upload a quote.',
		'action'    => 'Go to project',
	],

	'project_manager_assigned' => [
		'subject'   => ':Manager_name is now the Project Manager of your project.',
		'copy'      => ':Manager_name is now quoting your project. Feel free to send an email to :manager_email for any questions or comments.',
		'action'    => 'View project',
	],

	'new_project' => [
		'subject'   => 'New project is pending to quote',
		'copy'      => 'A new quote has been requested from a new project :project_name. Let a Project Manager take this project and upload a quote.',
		'action'    => 'Go to project',
	]

];
