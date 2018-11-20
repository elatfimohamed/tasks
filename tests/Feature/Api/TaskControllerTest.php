<?php

namespace Tests\Feature\Api;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;


class TaskControllerTest extends TestCase
{
    use RefreshDatabase , CanLogin;

    // CRUD -> CRU -> CREATE RETRIEVE UPDATE DELETE
    // BREAD -> PA -> BROWSE READ EDIT ADD DELETE
    /**
     * @test
     */
    public function task_manager_can_show_a_task()
    {

        $user = $this->login('api');
        initialize_roles();
        $user->assignRole('TaskManager');
        //1
        //TODO  assign permission to $user
        $task = factory(Task::class)->create();


        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean)$result->completed);
    }

    public function regular_user_cannot_show_a_task()
    {
//        $this->withoutExceptionHandling();
        // routes/api.php
        // http:// tasks.test/api/v1/tasks
        // HTTP -> GET | POST | PUT | DELETE
        $user = $this->login($this,'api');
        //1

        //TODO  assign permission to $user

        //Gate::define('task.store');
        // Task:create()
        $task = factory(Task::class)->create();

        // 2
        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean)$result->completed);
    }
    public function  superadmin_can_show_a_task()
    {

        $user = $this->login($this,'api');
        $user->admin = true;
        $user->save();
        //TODO  assign permission to $user

        //Gate::define('task.store');
        // Task:create()
        $task = factory(Task::class)->create();


        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);

        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean)$result->completed);
    }




    /**
     * @test
     */
    public function can_delete_task()
    {
//        $this->withoutExceptionHandling();
        // 1
        login($this,'api');
        $task = factory(Task::class)->create();

        // 2
        $response = $this->json('DELETE', '/api/v1/tasks/' . $task->id);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);
//        $this->assertDatabaseMissing('tasks', $task);
        $this->assertNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function cannot_create_task_without_name()
    {
        // 1
        login($this,'api');
        // 2
        $response = $this->json('POST', '/api/v1/tasks/', [
            'name' => ''
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function cannot_edit_task_without_name()
    {
        // 1
        login($this,'api');
        $oldTask = factory(Task::class)->create();
        // 2
        $response = $this->json('PUT', '/api/v1/tasks/' . $oldTask->id, [
            'name' => ''
        ]);

        // 3
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function can_create_task()
    {
//        $this->withoutExceptionHandling();
        // 1
        login($this,'api');
        // 2
        $response = $this->json('POST', '/api/v1/tasks/', [
            'name' => 'Comprar pa'
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        //        $this->assertDatabaseMissing('tasks', $task);
        $this->assertNotNull($task = Task::find($result->id));
        $this->assertEquals('Comprar pa', $result->name);
        $this->assertFalse($result->completed);
    }

    /**
     * @test
     */
    public function can_list_task()
    {
        login($this,'api');
        create_example_tasks();

        $response = $this->json('GET', '/api/v1/tasks/', [
            'name' => 'Comprar pa'
        ]);
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(3, $result);
        $this->assertEquals('comprar pa', $result[0]->name);
        $this->assertFalse((boolean)$result[0]->completed);

        $this->assertEquals('comprar llet', $result[1]->name);
        $this->assertFalse((boolean)$result[1]->completed);

        $this->assertEquals('Estudiar PHP', $result[2]->name);
        $this->assertTrue((boolean)$result[2]->completed);
    }

    /**
     * @test
     */
    public function can_edit_task()
    {
        // 1
        login($this,'api');
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet'
        ]);
        // 2
        $response = $this->json('PUT', '/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa'
        ]);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals('Comprar pa', $result->name);
        $this->assertFalse((boolean)$newTask->completed);

    }



}