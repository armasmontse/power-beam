<?php
return [
	'admin_menu'	=>	[
		'label'	=>	'Users',
		'create'	=>	'Create User',
		'index'	=>	'Users List',
		'trash'	=>	'Deleted Users List',
		'companies'	=>	'Companies',
	],
	'create' => [
		'label' => 'Users',
		'instructions' => 'Fill in the blanks to create an user',
		'form' => [
				'first_name'	=> [
						'label'	=>	'First Name',
						'placeholder' =>	'Michael',
				],
				'last_name'	=> [
						'label'	=>	'Last Name',
						'placeholder' =>	'Johnson',
				],
				'email'	=> [
						'label'	=>	'Email',
						'placeholder' =>	'mjohnson@mail.com',
				],
				'job_position' => [
						'label'	=>	'Job Position',
						'placeholder' =>	'CEO',
				],
				'phone'	=>	[
						'label'	=>	'Phone',
						'placeholder' =>	'55 7946 1346',
				],
				'photo'	=> [
						'label'	=>	'Profile Photo',
				],
				'save' =>	'Save',
			],
		'success'	=>	'User successfully created',
		'error'	=>	'User could not be created',
		],
		'index'	=> [
			'label' => 'Active Users List',
			'table'	=> [
				'name'	=>	'Name',
				'roles'	=>	'Roles',
				'email'	=>	'Email',
				'edit'	=>	'Edit',
				'delete'	=>	'Delete',
				'empty'	=>	'No active users'
			],
	],
	'trash'	=>	[
		'label' => 'Trashed Users List',
		'table'	=> [
			'name'	=>	'Name',
			'roles'	=>	'Roles',
			'email'	=>	'email',
			'recovery'	=>	'Recover',
			'empty'	=>	'No trashed users'
		],
	],
	'edit'	=>	[
			'label'	=>	'Edit user',
			'instructions'	=>	'Fill the form to update the user',
			'roles'	=>	[
				'label'	=>	'Select a role',
			],
			'success'	=>	'User successfully edited',
			'error'	=>	'User could not be edited',
	],
	'delete'	=>	[
		'success'	=>	'User successfully trashed',
		'error'	=>	'User could not be trashed',
	],
	'recovery'	=>	[
		'success'	=>	'User successfully recovered',
		'error'	=>	'User could not be recovered',
	],
	'associate'	=>	[
			'roles'	=>	[
					'success'	=>	'Role associated to the user successfully',
			],
	],
	'update'	=>	[

	]
];
