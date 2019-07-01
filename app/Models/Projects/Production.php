<?php 

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'project_production';

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'project_id',
		'data',
		'stackup',
		'routing',
		'highspeed',
		'power_supply'
	];

	/**
	 * The primitive values of every column.
	 *
	 * @var array
	 */
	protected $casts = [
		'data' => 'array',
		'stackup' => 'array',
		'routing' => 'array',
		'highspeed' => 'array',
		'power_supply' => 'array',
	];

	/**
	 * primaryKey 
	 * 
	 * @var integer
	 * @access protected
	 */
	protected $primaryKey = 'project_id';

	/**
	 * Indicates if the IDs are auto-incrementing.
	 *
	 * @var bool
	 */
	public $incrementing = false;

	public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
