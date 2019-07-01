<?php

return [
	'empty'	=>	[
		'title'	=>	'Projects List',
		'link'	=>	'CREATE NEW PROJECT'
	],
	'create'	=>	[
		'success'	=>	'Project created successfully',
		'uploadbom'	=>	[
			'bom_file' => [
				'required' => 'You must drag and drop or browse a file before saving.',
				'file' => 'The bom file was not uploaded successfully.',
				'mimes' => 'The bom file must have "bom","xlsx","xls", or "csv" extensions.',
			]
		],
		'dwg_file'	=>	[
			'dwg_file' => [
				'required' => 'You must drag and drop or browse a file before saving.',
				'file' => 'The dwg file was not uploaded successfully.',
				'mimes' => 'The bom file must have "dwg", "dfx", "pdf", or "dxf" extensions.',
			]
		],
		'uploaddata'	=>	[
			'data_input' => [
				'required' => 'You must drag and drop or browse a file before saving.',
				'file' => 'The file was not uploaded successfully.',
				'mimes' => 'The bom file must have "zip" extension.',
			]
		],
	],
	'admin_menu' => [
		'label' => 'Projects',
		'index' => 'Projects List',
	],
	'index' => [
		'label' 		=> 'All Projects List',
		'instructions' 	=> 'Manage Projects',
		'table' => [
			'name' => 'Project name',
			'code' => 'Code',
			'user' => 'User name',
			'manager' => 'Manager name',
			'status' => 'Status',
			'updated_at' => 'Updated at',
			'show' => 'View',
			'edit' => 'Edit'
		]
	],
	'edit' => [
		'label' 		=> 'Edit project',
		'instructions' 	=> 'Update project info'
	],
	'show' => [
		'label' 		=> 'View project',
		'instructions' 	=> 'View project details'
	],
	'addNote'	=>	[
		'success' => 'Note successfully added to the project.',
	],
	'next'	=>	[
		'success' => 'Project advanced successfully to the next step.',
	],
	'error'	=>	[
		'success' => 'Error notified successfully: due to it, project was set in step 1.',
	],
	'output'	=>	[
		'success' => 'Output File uploaded successfully. Process is Finished.',
	],
	'take'	=>	[
		'success' => 'You have now assigned a PM to this project. Congratulations!',
	],
	'placement'	=>	[
		'success' => 'Placement file uploaded successfully.',
	],
	'quote'	=>	[
		'success' => 'Quote sent successfully.',
	]

];
