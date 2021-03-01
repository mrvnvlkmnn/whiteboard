<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create 5 projects
        factory(App\Project::class, 5)->create();
        factory(App\User::class, 30)->create();
    }
}
