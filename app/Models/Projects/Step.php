<?php 

namespace App\Models\Projects;

class Step
{
	public $id;
	public $title;
	public $slug;
	public $order;
	public $status_slug;

	/**
	 * The steps of all statuses.
	 *
	 * @var array
	 */
	public static $steps = [
		[
			'id' => 1,
			'title' => 'Name',
			'slug' => 'name',
			'order' => 1,
			'status_slug' => 'new'
		],
		[
			'id' => 2,
			'title' => 'BOM',
			'slug' => 'bom',
			'order' => 2,
			'status_slug' => 'new'
		],
		[
			'id' => 3,
			'title' => 'DWG/DXF',
			'slug' => 'dwg',
			'order' => 3,
			'status_slug' => 'new'
		],
		[
			'id' => 4,
			'title' => 'Data inputs',
			'slug' => 'data',
			'order' => 4,
			'status_slug' => 'new'
		],
		[
			'id' => 5,
			'title' => 'Geometry info',
			'slug' => 'geometry',
			'order' => 5,
			'status_slug' => 'pending-info'
		],
		[
			'id' => 6,
			'title' => 'Stackup info',
			'slug' => 'stackup',
			'order' => 6,
			'status_slug' => 'pending-info'
		],
		[
			'id' => 7,
			'title' => 'Routing',
			'slug' => 'routing',
			'order' => 7,
			'status_slug' => 'pending-info'
		],
		[
			'id' => 8,
			'title' => 'High speed',
			'slug' => 'high-speed',
			'order' => 8,
			'status_slug' => 'pending-info'
		],
		[
			'id' => 9,
			'title' => 'Power supply',
			'slug' => 'power-supply',
			'order' => 9,
			'status_slug' => 'pending-info'
		],
		[
			'id' => 10,
			'title' => 'Altium and Orcad',
			'slug' => 'altium',
			'order' => 10,
			'status_slug' => 'pending-info'
		],
	];

	public static function get()
	{
		return collect(array_map(function($item) {
			return static::create($item);
		}, static::$steps));
	}

	// Creamos una instancia step.
	public static function create($args)
	{
		$step = new static;

		foreach ($args as $key => $value) {
			$step->$key = $value;
		}

		return $step;
	}

	// Buscamos un step a partir de un slug.
	public static function find($step_slug)
	{
		return static::get()->first(function($step, $key) use ($step_slug){
			return $step->slug == $step_slug; 
		});
	}

	// Obtenemos el status al que pertenece un step.
	public function status()
	{
		return Status::getObjectBySlug($this->status_slug);
	}
}