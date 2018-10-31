<?php

namespace Tests\Feature;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegisterAltControllerTest extends TestCase
{


    // Afegir register_alt a fitxer routers/web.php
    // Afegir Controller registerAltController i metode store
    // Dins del store:
    // 1) Objecte Request per la validació
    // 2) User:Create
    // 3) Login
    // 4) Redirect a  /home

    use RefreshDatabase;

    /**
     * @test
     */
    public function can_register_a_user()
    {
       $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);

        $this->assertNull(Auth::user());

        // 2
        $response = $this->post('/register_alt',$user =[
            'name' => 'mohamed',
            'email' => 'mohamed@iesebre.com',
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ]);
        //execucio

        $response->assertStatus(302);
        $response->assertRedirect('/home');
        $this->assertNotNull(Auth::user());
       // $this->assertNotNull(Auth::login($user);



        // Comprovat s'ha creat el suauri
        $this->assertEquals($user->email,Auth::user()->email);
        $this->assertEquals($user->name,Auth::user()->name);
        $this->assertTrue(Hash::check($user['password'], Auth::user()->password));



    }

    /**
     * @test
     */
    public function cannot_login_an_user_with_incorrect_password()
    {
//        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);

        $this->assertNull(Auth::user());

        // 2
        $response = $this->post('/login',[
            'email' => 'prova@gmail.com', //$user->email
            'password' => 'asdjaskdlasdasd0798asdjh'
        ]);
//        dd($response);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
    }

    /**
     * @test
     */
    public function cannot_login_an_user_with_incorrec_user()
    {
//        $this->withoutExceptionHandling();
        //1
        $user = factory(User::class)->create([
            'email' => 'prova@gmail.com'
        ]);

        $this->assertNull(Auth::user());

        // 2
        $response = $this->post('/login',[
            'email' => 'provaasdasdasd@gmail.com', //$user->email
            'password' => 'secret'
        ]);
//        dd($response);
        $response->assertStatus(302);
        $response->assertRedirect('/');
        $this->assertNull(Auth::user());
    }
}
