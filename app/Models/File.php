<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Projects\Project;
use App\Models\Projects\Quote;
use App\Models\Projects\PurchaseOrder;

use Storage;

class File extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'files';

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
	protected $appends = ['url'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'path',
		'name',
		// 'user_id'
	];

	/**
	 * The primitive values of every column.
	 *
	 * @var array
	 */
	protected $casts = [];

	// public function user()
	// {
	// 	return $this->belongsTo(User::class);
	// }

	public function getUrlAttribute()
	{
		return route('user::files.show', ['file' => $this]);
	}

	public function getRouteKeyName()
	{
		return 'name';
	}

	public function projects()
	{
		return $this->belongsToMany(Project::class)->withPivot('use')->withTimestamps();
	}

	public function quotes()
	{
		return $this->hasMany(Quote::class);
	}

	public function purchaseOrders()
	{
		return $this->hasMany(PurchaseOrder::class);
	}

	public function extension()
	{
		return substr(strrchr($this->name,'.'), 1);
	}
}