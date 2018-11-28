<?php

// PSR-4
namespace Tests\Feature;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasquesControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;


    // Accés url /tasques: Ordre recomanat

    // 1) Guest_user
    // 2) regular User -> No té cap rol (Pep Pringao)
    // 3) Superadmin (Sergi Tur Badenas)
    // 4) TaskManager (Home Simpson)
    // 5) Rol Tasks (Bart Simpson)

    /**
     * @test
     */
    public function guest_user_cannot_index_tasks()
    {
        $response = $this->get('/tasques');
        $response->assertRedirect('login');
    }

    /**
     * @test
     */
    public function regular_user_cannot_index_tasks()
    {
        $this->login();
        $response = $this->get('/tasques');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_can_index_tasks()
    {
        create_example_tasks();

        $this->loginAsSuperAdmin();
        $response = $this->get('/tasques');
        $response->assertSuccessful();
        $response->assertViewIs('tasques');
        $response->assertViewHas('tasks', function($tasks) {
            return count($tasks)===3 &&
                $tasks[0]['name']==='comprar pa' &&
                $tasks[1]['name']==='comprar llet' &&
                $tasks[2]['name']==='Estudiar PHP';
        });
    }

    /**
     * @test
     */
    public function task_manager_can_index_tasks()
    {
        create_example_tasks();

        $this->loginAsTaskManager();
        $response = $this->get('/tasques');
        $response->assertSuccessful();
        $response->assertViewIs('tasques');
        $response->assertViewHas('tasks', function($tasks) {
            return count($tasks)===3 &&
                $tasks[0]['name']==='comprar pa' &&
                $tasks[1]['name']==='comprar llet' &&
                $tasks[2]['name']==='Estudiar PHP';
        });
    }

    /**
     * @test
     */
    public function tasks_user_can_index_tasks()
    {
        create_example_tasks();

        $user = $this->loginAsTasksUser();
        $task = Task::create([
            'name' => 'Tasca usuari logat',
            'completed' => false,
            'description' => 'Jorl',
            'user_id' => $user->id
        ]);

        $response = $this->get('/tasques');
        $response->assertSuccessful();

        $response->assertViewIs('tasques');
        $response->assertViewHas('tasks', function($tasks) {
            return count($tasks)===1 &&
                $tasks[0]['name']==='Tasca usuari logat';
        });
    }

}