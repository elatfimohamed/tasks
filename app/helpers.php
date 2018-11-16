<?php

use App\Task;
use App\User;
use Spatie\Permission\Contracts\Role;

if (!function_exists('create_primary_user')) {
    function create_primary_user()
    {
        $user = User::where('email', 'mohamedelatfi@gmail.com')->first();
        if (!$user) {
            User::firstOrCreate([
                'name' => 'mohamed elatfi',
                'email' => 'mohamedatfi@iesebre.com',
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

    if (!function_exists('initialize_roles')) {
        function initialize_roles()
        {
            // Crear roles
            $taskManager = Role::create([
                'name' => 'TaskManeger'
            ]);
            $tasks = Role::create([
                'name' => 'Tasks'
            ]);

            // Crear permisos

            // GRUD de tasques
            Permission::create([
                'name' => 'tasks.destroy'
            ]);

            Permission::create([
                'name' => 'tasks.index'
            ]);
            Permission::create([
                'name' => 'tasks.show'
            ]);
            Permission::create([
                'name' => 'tasks.store'
            ]);
            Permission::create([
                'name' => 'tasks.update'
            ]);

            // assignar permissos a TASKMANAGER

            $taskManager->givePermissionTo('task.index');
            $taskManager->givePermissionTo('task.index');
            $taskManager->givePermissionTo('task.index');
            $taskManager->givePermissionTo('task.index');
            $taskManager->givePermissionTo('task.index');


            Permission::create([
                'name' => 'user.tasks.destroy'
            ]);

            $tasks->givePermissionTo('task.index');
            $tasks->givePermissionTo('task.index');
            $tasks->givePermissionTo('task.index');
            $tasks->givePermissionTo('task.index');
            $tasks->givePermissionTo('taks.destroy');


        }
    }
    if (!function_exists('initialize_roles')) {
        function initialize_roles()
        {
            // Crear roles
            try {
                $taskManager = Role::create([
                    'name' => 'TaskManager'
                ]);
            } catch (Exception $e) {

            }

            try {
                $tasks = Role::create([
                    'name' => 'Tasks'
                ]);
            } catch (Exception $e) {

            }


            // Crear permisos

            // CRUD de tasques
            try {
                Permission::create([
                    'name' => 'tasks.index'
                ]);
                //
//        Gate::define('tasks.index', function ($user) {
//            return $user->hasPermission('tasks.index');
//        });

                Permission::create([
                    'name' => 'tasks.show'
                ]);
                Permission::create([
                    'name' => 'tasks.store'
                ]);
                Permission::create([
                    'name' => 'tasks.update'
                ]);
                Permission::create([
                    'name' => 'tasks.complete'
                ]);
                Permission::create([
                    'name' => 'tasks.uncomplete'
                ]);
                Permission::create([
                    'name' => 'tasks.destroy'
                ]);
            } catch (Exception $e) {

            }

            try {
                // Assignar permissos a TaskManager
                $taskManager->givePermissionTo('tasks.index');
                $taskManager->givePermissionTo('tasks.show');
                $taskManager->givePermissionTo('tasks.store');
                $taskManager->givePermissionTo('tasks.update');
                $taskManager->givePermissionTo('tasks.complete');
                $taskManager->givePermissionTo('tasks.uncomplete');
                $taskManager->givePermissionTo('tasks.destroy');
            } catch (Exception $e) {

            }

            try {
                // CRUD TASQUES D'UN USUARI
                Permission::create([
                    'name' => 'user.tasks.index'
                ]);
                Permission::create([
                    'name' => 'user.tasks.show'
                ]);
                Permission::create([
                    'name' => 'user.tasks.store'
                ]);
                Permission::create([
                    'name' => 'user.tasks.update'
                ]);
                Permission::create([
                    'name' => 'user.tasks.complete'
                ]);
                Permission::create([
                    'name' => 'user.tasks.uncomplete'
                ]);
//        //
//        Gate::define('user.tasks.update', function ($user) {
//            return $user->hasPermission('user.tasks.update');
//        });
//
//        Gate::define('user.tasks.update', function ($user, $task) {
//            return $user->id === $task->user_id;
//        });
                Permission::create([
                    'name' => 'user.tasks.destroy'
                ]);
            } catch (Exception $e) {

            }


            try {
                $tasks->givePermissionTo('user.tasks.index');
                $tasks->givePermissionTo('user.tasks.show');
                $tasks->givePermissionTo('user.tasks.store');
                $tasks->givePermissionTo('user.tasks.update');
                $tasks->givePermissionTo('user.tasks.complete');
                $tasks->givePermissionTo('user.tasks.uncomplete');
                $tasks->givePermissionTo('user.tasks.destroy');
            } catch (Exception $e) {

            }
        }
    }
    if (!function_exists('sample_users')) {
        function sample_users()
        {
            // Superadmin no cal -> soc jo mateix

            // Pepe Pringao -> No té cap permis ni cap rol

            try {
                factory(User::class)->create([
                    'name' => 'Pepe Pringao',
                    'email' => 'pepepringao@hotmail.com'
                ]);
            } catch (Exception $e) {
            }

            try {
                $bartsimpson = factory(User::class)->create([
                    'name' => 'Bart Simpson',
                    'email' => 'bartsimpson@simpson.com'
                ]);
            } catch (Exception $e) {
            }

            try {
                $bartsimpson->assignRole('Tasks');
            } catch (Exception $e) {
            }

            try {
                $homersimpson = factory(User::class)->create([
                    'name' => 'Homer Simpson',
                    'email' => 'homersimpson@simpson.com'
                ]);
            } catch (Exception $e) {
            }

            try {
                $homersimpson->assignRole('TaskManager');
            } catch (Exception $e) {
            }
        }
    }
}