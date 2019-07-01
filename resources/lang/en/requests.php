<?php

return [
	'password' => [
		'required' => 'The password field is required.',
		'password_check' => 'Passwords must match.',
		'confirmed' => 'Please confirm your password.',
		'min' => 'Password must be at least 6 characters long.',
	],
	'email' => [
		'required' => 'The email field is required.',
		'email' => 'The email field must be a valid email.',
		'max' => 'The email is too long.',
		'unique' => 'The email is not available.',
		'not_in' => 'Please intriduce a different email.',
	],
	'old_password' => [
		'required' => 'The password field is required.',
		'password_check' => 'Passwords must match.',
	],
	'name' => [
		'required' => 'Your name is required.',
		'max' => 'Your name is too long.',
	],
	'last_name' => [
		'required' => 'Your lastname is required.',
		'max' => 'Your lastname is too long.',
	],
	'job_place' => [
		'required' => 'Your job position is required.',
		'max' => 'Your job position is too long.',
	],
	'phone' => [
		'required' => 'The phone field is required.',
		'max' => 'The phone is too long.',
	],
];