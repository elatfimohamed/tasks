<?php

use App\Task;
use App\User;

if (!function_exists('create_primary_user')) {
    function create_primary_user()
    {
        $user = User::where('email', 'mohamedelatfi@gmail.com')->first();
        if (!$user) {
            User::firstOrCreate([
                'name' => 'mohamed elatfi',
                'email' => 'mohamedelatfi@gmail.com',
                'password' => bcrypt(env('PRIMARY_USER_PASSWORD', '977580262'))
            ]);
        }
    }
}

if (!function_exists('create_example_tasks')) {
    function create_example_tasks()
    {
        Task::create([
            'name' => 'comprar pa',
            'completed' => false
        ]);

        Task::create([
            'name' => 'comprar llet',
            'completed' => false
        ]);

        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => true
        ]);
    }
}



    if (!function_exists('login')) {
        function login($test, $guard = null): void
        {
            $user = factory(User::class)->create();
            $test->actingAs($user, $guard); //WEB
            //        $this->actingAs($user,'api'); //API
        }
    }


if (!function_exists('create_mysql_database')) {
    function create_mysql_database($name) {
        // PDO
        // MYSQL: CREATE DATABASE IF NOT EXISTS $name
        $statement = "CREATE DATABASE IF NOT EXISTS $name";
        DB::connection('mysqlroot')->getPdo()->exec($statement);
    }
}


//if (!function_exists('create_mysql_user')) {
//    function create_mysql_user($name, $password =null, $host = 'localhost')
//    {
//        // PDO
//        // MYSQL: CREATE DATABASE IF NOT EXISTS $name
//        if()
//        DB::connection('mysqlroot')->getPdo()->exec($statement);
//    }
//}








