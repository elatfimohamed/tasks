<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 19/10/18
 * Time: 16:17
 */

namespace Tests\Unit;

use App\File;
use App\Tag;
use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class TaskTest extends TestCase
{
    use refreshDatabase;

    /**
     * @test
     */
    public function can_toggle_completed()
    {
        $task = factory(Task::class)->create([
            'completed' => false
        ]);
        $task->toggleCompleted();
        $this->assertTrue($task->completed);

        $task = factory(Task::class)->create([
            'completed' => true
        ]);
        $task->toggleCompleted();
        $this->assertFalse($task->completed);
    }

    /**
     * @test
     */
    public function can_assign_user_to_task()
    {
        // 1
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);

        $userOriginal = factory(User::class)->create();

        // 2
        $task->assignUser($userOriginal);

        // 3
        $user = $task->user;
        $this->assertTrue($user->is($userOriginal));
    }

    /**
     * @test
     */
    public function a_task_can_have_one_file()
    {
        //1
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);
        $fileOriginal = File::create([
            'path' => 'fitxer1.pdf'
        ]);

        $task->assignFile($fileOriginal);

        //2
        // IMPORTANT 2 maneres
        //Torna tota la relació, treball extra
//        $file = $task->file()->where('path','');
        //Això retorna el objecte
        $file = $task->file;
        //3
        $this->assertTrue($file->is($fileOriginal));
    }

    /**
     * @test
     */
    public function a_task_can_have_tags()
    {
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa',
            'description' => 'pa'
        ]);

        $tag1 = Tag::create([
            'name' => 'home',
            'description' => 'home',
            'color' => 'blau'
        ]);
        $tag2 = Tag::create([
            'name' => 'work',
            'description' => 'work',
            'color' => 'groc'
        ]);
        $tag3 = Tag::create([
            'name' => 'studies',
            'description' => 'studies',
            'color' => 'rosa'
        ]);

        $tags = [$tag1, $tag2, $tag3];

        // execució
        $task->addTags($tags);

        // Assertion
        $tags = $task->tags;

        $this->assertTrue($tags[0]->is($tag1));
        $this->assertTrue($tags[1]->is($tag2));
        $this->assertTrue($tags[2]->is($tag3));
    }

    /**
     * @test
     */
    public function a_assign_tag_to_task()
    {
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);

        $tag = Tag::create([
            'name' => 'home',
            'description' => 'home',
            'color' => 'blau'
        ]);

        // execució
        $task->addTag($tag);

        // Assertion
        $tags = $task->tags;

        $this->assertTrue($tags[0]->is($tag));

    }

    /**
     * @test
     */
    public function a_task_file_returns_null_when_no_file_is_assigned()
    {
        //1
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);
        //2
        $file = $task->file;
        //3
        $this->assertNull($file);
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

        $task  = create_sample_task($user);

        $mappedTask = $task->map();
        //dd($mappedTask);
        $this->assertEquals($mappedTask['id'],1);
        $this->assertEquals($mappedTask['name'],'Comprar pa');
        $this->assertEquals($mappedTask['description'],'Bla bla bla');
        $this->assertEquals($mappedTask['completed'],false);
        $this->assertEquals($mappedTask['user_id'],$user->id);
        $this->assertEquals($mappedTask['user_name'],$user->name);
        $this->assertEquals($mappedTask['user_email'],$user->email);
        $this->assertNotNull($mappedTask['created_at']);
        $this->assertNotNull($mappedTask['created_at_formatted']);
        $this->assertNotNull($mappedTask['created_at_human']);
        $this->assertNotNull($mappedTask['created_at_timestamp']);
        $this->assertNotNull($mappedTask['updated_at']);
        $this->assertNotNull($mappedTask['updated_at_human']);
        $this->assertNotNull($mappedTask['updated_at_formatted']);
        $this->assertNotNull($mappedTask['updated_at_timestamp']);
        $this->assertEquals($mappedTask['user_gravatar'],'https://www.gravatar.com/avatar/6849ef9c40c2540dc23ad9699a79a2f8');
        $this->assertEquals($mappedTask['full_search'],'1 Comprar pa Bla bla bla Pendent Pepe Pardo Jeans pepepardo@jeans.com');

        //dump($mappedTask['tags'][0]);
        $this->assertEquals($mappedTask['tags'][0]->name,'Tag1');
        $this->assertEquals($mappedTask['tags'][0]->color,'blue');
        $this->assertEquals($mappedTask['tags'][0]->description,'bla bla bla');
        $this->assertEquals($mappedTask['tags'][1]->name,'Tag2');
        $this->assertEquals($mappedTask['tags'][1]->color,'red');
        $this->assertEquals($mappedTask['tags'][1]->description,'Jorl Jorl');

        // TODO fullsearch
        $this->assertTrue($user->is($mappedTask['user']));
    }

}