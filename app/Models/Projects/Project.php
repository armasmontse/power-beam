<?php

namespace App\Models\Projects;

use Auth;
use Exception;
use App\Models\File;
use App\Models\Users\User;
use App\Models\Traits\UniqueSlugTrait;
use App\Models\Traits\Project\ValidationTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
	use UniqueSlugTrait;
	use ValidationTrait;
	use SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';
	
	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [
		'show_url',
		'admin_show_url',
		'admin_edit_url',
		'accepted_quote',
		'last_quote',
		'output_file',
		'is_deletable'
	];
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'slug',
		'code',
		'status',
		'error',
		'read_at'
	];

	protected $dates = [
		'read_at',
		'deleted_at'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The primitive values of every column.
	 *
	 * @var array
	 */
	protected $casts = [
	];

	public static $file_uses = [
		'bom' => 'bom',
		'dwg' => 'dwg',
		'data' => 'data',
	];

	public function getColLabelName()
	{
	    return "name";
	}

	/**
	 * Save data before creatign the project.
	 *
	 * @var array
	 */
	public static function boot()
	{
		parent::boot();

        self::creating(function($model){
			if(empty($model->user_id)){
				$model->user_id = Auth::user()->id;
			}
            $model->code = uniqid();
            $model->slug = static::generateUniqueSlug($model->name);
			if(empty($model->status_id)){
            	$model->status_id = Status::getStatusForNewProject()->id;
			}
        });
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function status()
    {
    	return $this->belongsTo(Status::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function manager()
    {
    	return $this->belongsTo(User::class, 'manager_id');
    }

    public function getShowUrlAttribute()
    {
    	return route('user::projects.show', [
    		'user' => $this->user,
    		'user_project' => $this
    	]);
    }

	public function getAdminShowUrlAttribute()
    {
    	return route('admin::projects.show', [
    		'projects_admin' => $this->id
    	]);
    }

	public function getAdminEditUrlAttribute()
    {
    	return route('admin::projects.edit', [
    		'projects_admin' => $this->id
    	]);
	}

    public function files()
    {
    	return $this->belongsToMany(File::class)->withPivot('use')->withTimestamps();
    }

    public function getFilesByUse($use = '')
    {
    	return $this->files()->wherePivot('use', $use)->get();
    }

    public function getFileByUse($use = '')
    {
    	return $this->getFilesByUse($use)->first();
    }

    public function hasFile($use)
    {
    	return ! is_null($this->getFileByUse($use));
	}

    public function currentStep()
    {
    	if (!$this->status->hasSteps()) {
    		return null;
    	}

    	foreach ($this->status->steps as $step) {
    		if (!$this->completedStep($step)) {
    			return $step;
    		}
    	}

    	// Si todos están completados regresamos el último step.
    	return $step;
    }

    public function completedStep($step)
    {
    	// Validamos ese step para el proyecto.
    	$validation = 'validateStep' . studly_case(str_replace('.', '-', $step->slug));

    	if (method_exists($this, $validation)) {
    		$result = $this->{$validation}();
    	}else {
    		$result = true;
    	}

    	return $result;
    }

    public function completedAllSteps()
    {
    	if (!$this->status->hasSteps()) {
    		return true;
    	}

    	foreach ($this->status->steps as $step) {
    		if (!$this->completedStep($step)) {
    			return false;
    		}
    	}

    	return true;
    }

    public function completedStatus()
    {
    	// Validamos ese status para el proyecto.
    	$validation = 'validateStatus' . studly_case(str_replace('.', '-', $this->status->slug));

    	if (method_exists($this, $validation)) {
    		$complete = $this->{$validation}();
    	}else {
    		$complete = true;
    	}

    	return $complete && $this->completedAllSteps() && $this->generalValidation();
    }

    // Validaciones generales para todos los status.
    public function generalValidation()
    {
    	// Validamos que los dos campos esten llenos o estén vacios al mismo tiempo.
    	if (is_null($this->error) ^ is_null($this->read_at)) {
    		return false;
    	}

    	return true;
    }

	// Ir al siguiente estatus del proyecto.
    public function next()
    {
    	if (!$this->completedStatus()) {
    		throw new Exception("Project has not completed all steps in this status.", 1);
    	}

    	$status = Status::where('status_id', $this->status->id)->first();

    	if (!is_null($status)) {
    		$this->go($status);
    	}

        return $this;
    }

    public function before()
    {
    	$status = Status::where('id', $this->status->status_id)->first();

    	if (!is_null($status)) {
    		$this->go($status);
    	}

        return $this;
    }

    public function go(Status $status)
    {
    	$this->status()->associate($status);
		$this->save();
    }

    public function production()
    {
    	return $this->hasOne(Production::class);
    }

    public function quotes()
    {
    	return $this->hasMany(Quote::class);
    }

    public function getAcceptedQuoteAttribute()
    {
    	return $this->quotes()->where('decision', true)->with('file')->first();
    }

    public function getLastQuoteAttribute()
    {
    	return $this->quotes()->orderBy('created_at', 'DESC')->with('file')->first();
    }

    public function getOutputFileAttribute()
    {
    	return $this->getFileByUse('output');
    }

    public function notes()
    {
    	return $this->hasMany(Note::class)->orderBy('created_at', 'DESC');
    }

    public function getCodeAttribute($value)
    {
    	return strtoupper($value);
	}
	
	public function getIsDeletableAttribute()
	{
		// Si estatus es new y no tiene notas ni cotizaciones.
		return $this->status->slug == 'new';
	}
}
