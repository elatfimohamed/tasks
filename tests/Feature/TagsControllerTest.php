<?php

// PSR-4
namespace Tests\Feature;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsControllerTest extends TestCase
{
    use RefreshDatabase;

//    use WithoutMiddleware;

    /**
     * @test
     */
    public function can_show_tags()
    {
//        $this->withoutExceptionHandling();

        //1 Prepare
        create_example_tags();
        login($this);

//        dd(Task::find(1));

        // 2 execute
        $response = $this->get('/tags');
        $response->assertSuccessful();
        $response->assertSee('Tasques');

        $response->assertSee('comprar pa');
        $response->assertSee('comprar llet');
        $response->assertSee('Estudiar PHP');


    }

    /**
     * @test
     */

    public function guest_user_can_show_tags()
    {
//        $this->withoutExceptionHandling();


        // 2 execute
        $response = $this->get('/tags');
        $response->assertRedirect('');

    }

    /**
     * @test
     */
    public function regular_user_can_show_tags()
    {
//        $this->withoutExceptionHandling();


        // 2 execute
        $response = $this->get('/tags');
        $response->assertRedirect('');

    }

    /**
     * @test
     */

    public function superadmin_user_can_show_tags()
    {



    }


    public function logingAsUsingRole($guard = null, $role)
    {
        initialize_roles();
        $user = factory(User::class)->create();
        $user->assignRole($role);
        $this->actingAs($user);

        // 2 execute
        $response = $this->get('/tags');
        $response->assertRedirect('');
    }


    public function logingAsgRole($guard = null, $role)
    {
        initialize_roles();
        $user = factory(User::class)->create();
        $user->assignRole($role);
        $this->actingAs($user);

        // 2 execute
        $response = $this->get('/tags');
        $response->assertRedirect('');
    }

}





