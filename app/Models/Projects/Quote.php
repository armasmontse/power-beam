<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;

use App\Models\File;

use Laravel\Cashier\Cashier;

class Quote extends Model
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quotes';

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
		'file_id',
		'amount',
		'decision',
		'decided_at',
		'feedback'
	];

	/**
	 * The primitive values of every column.
	 *
	 * @var array
	 */
	protected $casts = [
		'amount' => 'integer'
	];

	protected $dates = [
		'decided_at'
	];

	public function project()
	{
		return $this->belongsTo(Project::class);
	}

	public function file()
	{
		return $this->belongsTo(File::class);
	}

	public function payment()
	{
		return $this->hasOne(Payment::class);
	}

	public function getFormatedAmountAttribute()
	{
		return Cashier::formatAmount($this->amount) . ' ' . strtoupper($this->preferredCurrency());
	}

	/**
     * Get the Stripe supported currency used by the entity.
     *
     * @return string
     */
    public function preferredCurrency()
    {
        return Cashier::usesCurrency();
    }

    public function getAdminUrlAttribute()
    {
    	return route('admin::projects.quotes.show', [
    		'admin_project' => $this->project->id,
    		'admin_quote' => $this->id,
    	]);
    }
}
