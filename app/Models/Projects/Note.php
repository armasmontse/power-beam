<?php 

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Note extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'notes';

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
    	'project_id', 'user_id', 'message'
    ];

    /**
     * The primitive values of every column.
     *
     * @var array
     */
	protected $casts = [];
	
	public function user() 
	{
		return $this->belongsTo(User::class);
	}
}