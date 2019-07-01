<?php

namespace App\Models\Users;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Users\Company;

use App\Models\Projects\Project;

use App\Models\Traits\User\PermissionRoleTrait;
use App\Models\Traits\PhotoableTrait;

use App\Notifications\Client\ResetPasswordNotification;

use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use SoftDeletes;
    use PermissionRoleTrait;
    use PhotoableTrait;
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'active',
        'job_position',
        'company_id',
    ];

    /**
     * The suffix of the varible name
     * @var string
     */
    const VARIABLE_SUFFIX = "image";

    public static $image_uses = [
        'thumbnail',
    ];

    public static $image_galleries = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'roles'
    ];

    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean'
    ];

    protected $appends = [
        'roles_ids',
        'full_name',
        'thumbnail_image',
    ];
    /**
     * creamos al usuario registrado desde el admin
     * @param array $input valores del request
     * @return User  usuario creado
     */
    public static function CltvoCreate(array $input)
    {
        // Creamos el usuario
        $user = static::create([
            'name'          =>  trim($input['name']),
            'email'         =>  trim($input['email']),
            'first_name'    =>  trim($input['first_name']),
            'last_name'     =>  trim($input['last_name']),
            'password'      =>  bcrypt($input['password']),
            'active'        =>  $input['active'],
            'job_position'  =>  array_key_exists('job_position', $input) ? trim($input['job_position']) : null,
            'phone'         =>  array_key_exists('phone', $input) ? trim($input['phone']) : null,
            'company_id'    =>  array_key_exists('company', $input) ? trim($input['company']) : null,
        ]);

        return $user;
    }

    public static function setRandomPassword()
    {
        return str_random(4).mt_rand(1, 10).str_random(4).mt_rand(10, 99).str_random(4);
    }

    /**
     * genera un nombre de usuario unico a partir del nombre y apellido
     * @param  string $firstName nombre
     * @param  string $lastName  apellido
     * @return string            nombre de usuario unico
     */
    public static function createUniqueUsername($firstName,$lastName)
    {
        $username = str_slug(trim($firstName)." ".trim($lastName)." ".rand(0,99));

        $userNameNotUnique = true;

        while ($userNameNotUnique) {
            $users = static::withTrashed()->whereName($username)->get();
            if ($users->count() == 0) {
                $userNameNotUnique = false;
            }else {
                $username.= rand(0,9);
            }
        }

        return $username;
    }

    public function getFullNameAttribute()
    {
        return ucwords($this->first_name." ".$this->last_name);
    }

    public function isActive()
    {
        return  $this->active;
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    public function getHomeUrl()
    {
        return route("user::profile", $this->name);
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function getActivationAcountUrl()
    {
        return route("client::pass_set:get", cltvoMailEncode($this->email));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function projects()
    {
    	return $this->hasMany(Project::class);
    }

    // Logica para valida si un usuario puede hacer purchase orders.
    public function getCanMakePurchaseOrdersAttribute()
    {
    	return true;
    }

    public function getPaymentsAttribute()
    {
    	return $this->projects->map(function($project) {
    		if (!is_null($project->accepted_quote)) {
    			if (!is_null($project->accepted_quote->payment)) {
    				return $project->accepted_quote->payment;
    			}
    		}
    	})->filter(function($payment) {
    		return !is_null($payment);
    	});
    }

}
