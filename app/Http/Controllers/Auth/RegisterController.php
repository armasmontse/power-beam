<?php

namespace App\Http\Controllers\Auth;

use Validator;

use App\Http\Controllers\ClientController;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

use App\Models\Users\User;
use App\Models\Users\Company;

use App\Notifications\Client\RegisterUserNotification;

use App\Http\Helpers\Traits\Auth\RedirectPathTrait;

class RegisterController extends ClientController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    use RegistersUsers,RedirectPathTrait {
        RedirectPathTrait::redirectPath insteadof RegistersUsers;
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        parent::__construct();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' 	=> 'required|max:255',
            'last_name'  	=> 'required|max:255',
            'email' 	 	=> 'required|email|max:255|unique:users',
            'phone'  	 	=> 'required',
            'password' 	 	=> 'required|confirmed|min:6',
            'job_position' 	=> 'required',
            'company'	 	=> 'required|exists:companies,id',
            'terms'		 	=> 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
    	// Obtenemos los valores calculados.
    	$computed = [
    		'name' => User::createUniqueUsername($data['first_name'], $data['last_name']),
    		'active' => true
    	];

    	// Creamos el usuario
        $user = User::CltvoCreate(array_merge($data, $computed));

        return $user;
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $data = [
            'companies' => Company::get(),
        ];

        return view('auth.register', $data);
    }

	public function register(Request $request)
	{
		// Como recibimos un nombre obtenemos la compañia de la base de datos a partir de ese nombre.
		$data = $request->all();

		if (array_key_exists('company', $data)) {
			$data['company'] = Company::firstOrCreate(['name' => $data['company']])->id;
		}

        $this->validator($data)->validate();

        event(new Registered($user = $this->create($data)));

        $user->notify(new RegisterUserNotification(['user' => $user]));

		$this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
	}
}
