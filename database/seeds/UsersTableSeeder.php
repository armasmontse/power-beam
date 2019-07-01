<?php

use Illuminate\Database\Seeder;

use App\Models\Users\User;
use App\Models\Users\Company;
use App\Models\Users\Role;
use App\Models\Photo;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        $photo = Photo::get();
        $companies = Company::all();

        factory(User::class, config( "cltvo.base_seed")*25 )->create()->each(function($user) use ($photo,$roles,$companies){

		// role association
			if ( mt_rand(0, 9) <= 2 ) {
				$filter_roles = getRandomElements($roles) ;
		        $user->roles()->sync($filter_roles);
            }

        // image association
            if (!$photo->isEmpty() ) {
                if (rand(0,9) < 7) {
                    $user->associateImage($photo->random(1), [
                        'use'       => "thumbnail" ,
                        'order'     => null,
                        'class'     => null
                    ]);
                }
            }

        	// Company
            if(!$companies->isEmpty()){
                $user->company()->associate(getRandomElements($companies)->first());
                $user->save();
            }

        });
    }
}
