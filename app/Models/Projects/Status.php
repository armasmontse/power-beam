<?php 

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UniqueSlugTrait;

class Status extends Model
{
	use UniqueSlugTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'statuses';

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
	protected $fillable = [];

	/**
	 * The primitive values of every column.
	 *
	 * @var array
	 */
	protected $casts = [];

	public static function getStatusForNewProject()
	{
		return static::getObjectBySlug('new');
	}

	public function getStepsAttribute()
	{
		return Step::get()->filter(function($step) {
			return $step->status_slug == $this->slug;
		});
	}

	public function hasSteps()
	{
		return !! count($this->steps);
	}

	public function stepsInSingleRoute()
	{
		switch ($this->slug) {
			case 'new':
				return true;
				break;
			
			default:
				return false;
				break;
		}
	}

	public function getGroupAttribute()
	{
		return Group::get()->first(function($group, $key) {
			return $this->group_slug == $group->slug;
		});
	}
}