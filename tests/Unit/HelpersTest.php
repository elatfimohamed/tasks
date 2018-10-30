<?php

namespace Tests\Unit;


use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    use refreshDatabase;

    /**
     * @test
     */
    public function create_primary_user()
    {

        create_primary_user();

        $user = User::where('email', 'sergibaucells@gmail.com')->first();

        $this->assertEquals($user->name, 'Sergi Baucells');
        $this->assertEquals($user->email, 'sergibaucells@gmail.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD', '123456'), $user->password));

    }

}