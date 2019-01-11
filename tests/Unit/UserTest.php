<?php


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
    public function assignPhoto()
    {
        $user = factory(User::class)->create();
        $this->assertNull($user->photo);
        $photo = Photo::create([
            'url' => '/photo1.png',
        ]);
        $user->assignPhoto($photo);
        $user = $user->fresh();
        $this->assertNotNull(1,$user->photo);
        $this->assertEquals('/photo1.png',$user->photo->url);
        $this->assertEquals($user->id,$user->photo->id);
    }

    /**
     * @test
     */
    public function addAvatar()
    {
        $user = factory(User::class)->create();
        $this->assertCount(0,$user->avatars);
        $avatar = Avatar::create([
            'url' => '/avatar.png',
        ]);
        $user->addTask($avatar);
        $user = $user->fresh();
        $this->assertCount(1,$user->avatars);
        $this->assertEquals('/avatar.png',$user->avatars[0]->url);
        $this->assertEquals($user->id,$user->avatars[0]->id);
    }




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


    public function isSuperAdmin()
    {

        $user = factory(User::class)->create();
        dd($user->admin);
        $this->assertFalse($user->isSuperAdmin);
        $user->admin = true;
        $user->save();
        $this->assertTrue($user->isSuperAdmin());

    }

    /**
     * @test
     */
    public function map()
    {
        $user = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);

        $mappedUser = $user->map();

        $this->assertEquals($mappedUser['id'],1);
        $this->assertEquals($mappedUser['name'],'Pepe Pardo Jeans');
        $this->assertEquals($mappedUser['email'],'pepepardo@jeans.com');
        $this->assertEquals($mappedUser['gravatar'],'https://www.gravatar.com/avatar/6849ef9c40c2540dc23ad9699a79a2f8');






    }



    /** @test */
    public function regulars()
    {
        $this->assertCount(0,User::regular()->get());
        $user1 = factory(User::class)->create([
            'name' => 'Pepe Pardo Jeans',
            'email' => 'pepepardo@jeans.com'
        ]);
        $user2 = factory(User::class)->create([
            'name' => 'Pepa Parda Jeans',
            'email' => 'pepaparda@jeans.com'
        ]);
        $user3 = factory(User::class)->create([
            'name' => 'Pepa Pig',
            'email' => 'pepapig@dibus.com'
        ]);
        $user3->admin = true;
        $user3->save();
        $this->assertCount(2,$regularusers = User::regular()->get());
        $this->assertEquals($regularusers[0]->name,'Pepe Pardo Jeans');
        $this->assertEquals($regularusers[1]->name, 'Pepa Parda Jeans');
        try {
            $regularusers[2];
        } catch (Exception $e) {
            dump($e);
        }

    }
}

