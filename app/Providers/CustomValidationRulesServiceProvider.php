<?php

namespace App\Providers;

use DB;
use Hash;
use Validator;
use App\Models\Users\User;
use Illuminate\Support\ServiceProvider;

class CustomValidationRulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extendImplicit('password_check', function($attribute, $value, $parameters, $validator) {
            return Hash::check($value,$parameters[0]);
		});
		
		Validator::extendImplicit('has_permission', function($attribute, $value, $parameters, $validator) {
			return User::where('id', $value)->whereHasPermission($parameters[0])->count();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
