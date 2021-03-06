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


class TagTest extends TestCase
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
        $tag = Tag::create([
            'name' => 'Tag1',
            'color' => 'blue',
            'description' => 'bla bla bla',
        ]);
        $mappedTag = $tag->map();
        $this->assertEquals($mappedTag['id'],1);
        $this->assertEquals($mappedTag['name'],'Tag1');
        $this->assertEquals($mappedTag['description'],'bla bla bla');
        $this->assertNotNull($mappedTag['created_at']);
        $this->assertNotNull($mappedTag['created_at_formatted']);
        $this->assertNotNull($mappedTag['created_at_human']);
        $this->assertNotNull($mappedTag['created_at_timestamp']);
        $this->assertNotNull($mappedTag['updated_at']);
        $this->assertNotNull($mappedTag['updated_at_human']);
        $this->assertNotNull($mappedTag['updated_at_formatted']);
        $this->assertNotNull($mappedTag['updated_at_timestamp']);
        $this->assertEquals($mappedTag['full_search'],'1 Tag1 blue bla bla bla');
    }

}