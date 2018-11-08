<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 19/10/18
 * Time: 16:17
 */

namespace Tests\Unit;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserTest extends TestCase
{
    use refreshDatabase;

    /**
     * @test
     */
    public function can_add_tasks_to_user()
    {
        // 1
        $user = factory(User::class)->create();
        $task = factory(Task::class)->create();

        $user->addTask($task);

        //2
        $tasks = $user->tasks;

        // 3
        $this->assertTrue($tasks[0]->is($task));
    }

    /**
     * @test
     */
    public function user_can_have_tasks()
    {
        // 1
        $user = factory(User::class)->create();
        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();
        $user->addTask($task1);
        $user->addTask($task2);
        $user->addTask($task3);

        //2
        $tasks = $user->tasks;

        // 3
        $this->assertTrue($tasks[0]->is($task1));
        $this->assertTrue($tasks[1]->is($task2));
        $this->assertTrue($tasks[2]->is($task3));
    }

    /**
     * @test
     */
    public function user_tasks_return_null_when_no_tasks()
    {
        // 1
        $user = factory(User::class)->create();
        //2
        $tasks = $user->tasks;
        // 3
        $this->assertEmpty($tasks);
    }

}