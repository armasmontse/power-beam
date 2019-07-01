<?php

use Illuminate\Database\Seeder;

use App\Models\Projects\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        factory(Project::class, 50)->create();

    }
}
