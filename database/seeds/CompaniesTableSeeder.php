<?php

use Illuminate\Database\Seeder;

use App\Models\Users\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        
        factory(Company::class, 5)->create()->each(function($company) {

        });

    }
}
