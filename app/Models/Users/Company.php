<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\UniqueSlugTrait;
use App\Models\Users\User;

class Company extends Model
{
	use UniqueSlugTrait;

	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'slug'
	];

	protected $dates = [
		'created_at',
		'updated_at',
	];

	/**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [

    ];

	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

	/**
	 * Save data before creatign the project.
	 *
	 * @var array
	 */
	public static function boot()
	{
		parent::boot();

        self::creating(function($model){
            $model->slug = static::generateUniqueSlug($model->name);
        });
    }

	public function isDeletable()
    {
        $total = 0;
        $total += $this->users->count();
        return $total == 0;
    }

	public function getColLabelName()
	{
		return "name";
	}

	public function users()
    {
        return $this->hasMany(User::class);
    }

}
