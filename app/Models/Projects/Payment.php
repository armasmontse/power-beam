<?php 

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

use Laravel\Cashier\Cashier;

class Payment extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'payments';

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
		'code',
		'quote_id',
		'amount',
		'currency',
		'payment_status',
		'metadata',
		'payable_id',
		'payable_type',
	];

	/**
	 * The primitive values of every column.
	 *
	 * @var array
	 */
	protected $casts = [
		'amount' => 'integer',
		'metadata' => 'array'
	];

	public function getCodeAttribute($value)
	{
		return strtoupper($value);
	}

	public function quote()
	{
		return $this->belongsTo(Quote::class);
	}

	public function getFormatedAmountAttribute()
	{
		return Cashier::formatAmount($this->amount) . ' ' . strtoupper($this->currency);
	}
}