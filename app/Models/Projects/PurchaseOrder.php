<?php 

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'purchase_orders';

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
	protected $fillable = ['id', 'file_id'];

	/**
	 * The primitive values of every column.
	 *
	 * @var array
	 */
	protected $casts = [];

	/**
	 * The primary key not autoincrement.
	 *
	 * @var array
	 */
	public $incrementing = false;

	public static function boot()
	{
		parent::boot();

        self::creating(function($model){
			$model->id = self::generateId();
        });
    }

    public static function generateId()
    {
    	return 'po_' . str_random(24);
    }
}