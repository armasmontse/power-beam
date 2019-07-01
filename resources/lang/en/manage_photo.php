<?php
return [
	'file_input' => [
		'max'	=>	'Image weight must be up to 2 MB',
		'image'	=>	'File must be image type',
		'required'	=>	'Have to choose image type file',
	],

	'create'	=>	[
		'error'		=>	'This image could not be created',
		'exist'		=>	"This image it was loaded previously",
		'store'		=>	"This image could not be saved",
		'success'	=>	"Image saved successfully",
		'form'		=>	[
			'save'	=>	'Save order'
		]
	],

	'edit'		=>	[
		'error'		=>	"Image you are trying to modify does not exist"
	],

	'update'	=>	[
		'success'	=>	"Image updated successfully",
		'form'	=>	[
			'title'			=>	'Title',
			'alt'			=>	'Alternative text',
			'description'	=>	'Description'
		]
	],

	'delete'	=>	[
		'error'		=>	"Image could not be deleted",
		'success'	=>	"Image deleted successfully"
	],

	'deletable'	=>	[
		'error'		=>	"Image you are trying to delete is in use"
	],

	'associate'	=>	[
		'exist'		=>	"You have previously associated an image",
		'use'		=>	"You have already associated an image",
		'error'		=>	"Image could not be associated",
		'success'	=>	"Image associated successfully"
	],

	'dissasociate'	=>	[
		'use'		=>	"You have no associated imaged",
		'success'	=>	"Image dissasociated successfully",
		'error'		=>	"Image could not be dissasociated"
	],

	'sort'		=>	[
		'success'	=>	"Order saved successfully",
		'label'		=>	'Order for:'
	],

	'index'		=>	[
		'label'		=>	'Media manager'
	],

	'drop'		=>	[
		'label'		=>	'Drag and drop and image to add it'
	],

	'button'	=>	[
		'add'		=>	'Add image',
		'change'	=>	'Change',
		'remove'	=>	'Remove',
		'delete'	=>	"Delete",
		'save'		=>	'Save'
	],

	'add'		=>	[
		'label'	=>	'Drag and drop and image to add it'
	],

	'title'		=>	'Gallery',

	'footer'	=>	[
		'label'	=>	'El Cultivo'
	],

	'recovering'	=>	'Recovering images ...',

	'select'		=>	'Select',

	'chose'			=>	[
		'label'		=>	'Created in:'
	]

];
