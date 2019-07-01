<?php

use App\Models\Projects\Project;
use App\Models\Users\User;
use App\Models\Projects\Status;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/**
 * factory companies
 */
$factory->define(Project::class, function (Faker\Generator $faker){

    $manager =  DB::table('users')
                            ->join('role_user', 'users.id', '=', 'role_user.user_id')
                            ->join('roles', 'role_user.role_id', '=', 'roles.id')
                            ->where('roles.id','=',3)
                            ->select('users.id')
                            ->orderByRaw('RAND()')
                            ->first();
    return [
        'status_id'     => Status::all()->random()->id,
        "name"          => $faker->company,
        'user_id'       => User::all()->random()->id,
        'manager_id'    => $manager->id,
    ];

});
