<?php

use App\Models\Users\Company;


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
$factory->define(Company::class, function ($faker) use ($factory) {

    $name = $faker->company;
    return [
        "name"  => $name,
        "slug"  => Company::generateUniqueSlug($name),
    ];
});
