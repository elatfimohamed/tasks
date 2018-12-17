<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        initialize_roles();
        create_primary_user();
        create_example_tasks();
        create_sample_users();
        create_sample_users_and_tasks();




    }


}
