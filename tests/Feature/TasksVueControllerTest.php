<?php

namespace Tests\Feature;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksVueControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function can_show_vue_tasks()
    {
        $this->withoutExceptionHandling();
        // Prepare
        create_example_tasks();
        // Execute
        $response = $this->get('/tasks_vue');
        // Assert
        $response->assertSuccessful();
        $response->assertViewIs('tasks_vue');
        $response->assertViewHas('tasks',Task::all());

    }

}
