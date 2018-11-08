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

    if (!function_exists('create_example_tags')) {
        function create_example_tags()
        {
            Tag::create([
                'name' => 'Etiqueta 1',
                'description' => 'Descripció',
                'color' => '#000000'
            ]);

            Tag::create([
                'name' => 'Etiqueta 2',
                'description' => 'Descripció',
                'color' => '#000000'
            ]);

            Tag::create([
                'name' => 'Etiqueta 3',
                'description' => 'Descripció',
                'color' => '#000000'
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
        function create_mysql_database($name)
        {
            $statement = "CREATE DATABASE IF NOT EXISTS $name";
            DB::connection('mysqlroot')->getPdo()->exec($statement);
        }
    }

    if (!function_exists('drop_mysql_database')) {
        function drop_mysql_database($name)
        {
            $statement = "CREATE DATABASE IF EXISTS $name";
            DB::connection('mysqlroot')->getPdo()->exec($statement);
        }
    }

    if (!function_exists('create_mysql_user')) {
        function create_mysql_user($name, $password = null, $host = 'localhost')
        {
            if (!$password) $password = str_random();
            $statement = "CREATE USER IF NOT EXISTS {$name}@{$host}";
            DB::connection('mysqlroot')->getPdo()->exec($statement);
            $statement = "ALTER USER '{$name}'@'{$host}' IDENTIFIED BY '{$password}'";
            DB::connection('mysqlroot')->getPdo()->exec($statement);
            return "El password aleatori es: {$password}";
        }
    }

    if (!function_exists('grant_mysql_privileges')) {
        function grant_mysql_privileges($name, $database, $host = 'localhost')
        {
            $statement = "GRANT ALL PRIVILEGES ON {$database}.* TO '{$name}'@'{$host}' WITH GRANT OPTION";
            DB::connection('mysqlroot')->getPdo()->exec($statement);
            $statement = "FLUSH PRIVILEGES";
            DB::connection('mysqlroot')->getPdo()->exec($statement);
        }
    }

    if (!function_exists('create_database')) {
        function create_database()
        {
            create_mysql_database(env('DB_DATABASE'));
            create_mysql_user(env('DB_USERNAME'), env('DB_PASSWORD'));
            grant_mysql_privileges(env('DB_USERNAME'), env('DB_DATABASE'));
        }
    }
}






