<?php
namespace Tests\Unit;
use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
class HelpersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function create_primary_user()
    {
        create_primary_user();
        $user = User::where('email','mohamedelatfi@gmail.com')->first();
        $this->assertEquals($user->name, 'Mohamed Elatfi');
        $this->assertEquals($user->email, 'mohamedelatfi@gmail.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD','977580262'), $user->password));
    }
}

