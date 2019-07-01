<?php
return [
	'layout'	=>	[
		'my_account'	=> 'My Account',
	],
	'update_email'	=>	[
		'update_label'	=>	'Update User email',
		'label'	=>	'Update user email',
		'form'	=>	[
				'email'	=>	[
					'placeholder'	=>	'New email',
				],
				'password'	=>	[
					'placeholder'	=>	'Password'
				],
				'save' => 'Save'
		],
		'form_update'	=>	[
			'ttl'	=>	'Change Email',
			'save_change'	=>	'Save New Email',
		],
	],
	'update_password'	=>	[
		'update_label'	=>	'Update user password',
		'label'	=>	'Update user password',
		'form'	=>	[
			'old_password' => [
				'placeholder'	=>	'Old Password',
			],
			'password' => [
				'placeholder'	=>	'New Password',
			],
			'password_confirmation' => [
				'placeholder'	=>	'New Password Confirmation',
			],
			'save'	=>	'Save'
		],
		'form_update'	=>	[
			'ttl'	=>	'Change Password',
			'save_change'	=>	'Save New Password',
		],
	],
	'show_info'		=> [
		'form'		=> [
			'name'		=> [
				'placeholder'	=>	'First Name',
			],
			'last_name'		=> [
				'placeholder'	=>	'Last Name',
			],
			'company_name'		=> [
				'placeholder'	=>	'Company Name',
				'alert'			=>	'* To modify the company, you must contact an executive',
			],
			'job_place'		=> [
				'placeholder'	=>	'Job position',
			],
			'phone'		=> [
				'placeholder'	=>	'Telephone',
			],
			'email'		=> [
				'placeholder'	=>	'E-mail',
			],
			'password'		=> [
				'placeholder'	=>	'Password',
			],
			'save_update'	=>	'Save new info',

		]
	],
	'payment'	=>	[
		'title'	=>	'Payment history',
	],
	'new_project'	=>	[
		'title'	=>	'New Projects',
		'sbtitle'	=>	'Step 1. Input project name'
	]
];
