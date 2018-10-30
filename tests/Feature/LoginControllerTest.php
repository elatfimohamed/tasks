<?php

namespace Tests\Feature;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_login_a_user()
    {
//        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);

        $this->assertNull(Auth::user());

        //2
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret'
        ]);

        //3
        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());
        $this->assertEquals($user->email, Auth::user()->email);

    }

    /**
     * @test
     */
    public function cannot_login_a_user_with_incorrect_password()
    {
//        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);

        $this->assertNull(Auth::user());

        //2
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'gaerhharth'
        ]);

        //3
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());

    }

    /**
     * @test
     */
    public function cannot_login_a_user_with_user_password()
    {
//        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);

        $this->assertNull(Auth::user());

        //2
        $response = $this->post('/login', [
            'email' => 'argaergha@gmail.com',
            'password' => 'secret'
        ]);

        //3
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());

    }

}