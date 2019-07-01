<?php 

namespace App\Models\Projects;

class Group
{
	public $title;
	public $slug;

	public static $groups = [
		[
			'title' => 'Quick turn',
			'slug' => 'quick-turn',
		],
		[
			'title' => 'Quoting',
			'slug' => 'quoting',
		],
		[
			'title' => 'Production',
			'slug' => 'production',
		],
	];

	public static function get()
	{
		return collect(array_map(function($item) {
			return static::create($item);
		}, static::$groups));
	}

	// Crea una nueva instancia de grupo de statuses.
	public static function create($args)
	{
		$group = new static;

		foreach ($args as $key => $value) {
			$group->$key = $value;
		}

		return $group;
	}

	// Regresa los statuses que pertenecen a ese grupo.
	public function statuses()
	{
		return Status::where('group_slug', $this->slug)->get();
	}

}