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
        $user = User::where('email','mohamedelatfi@iesebre.com')->first();
        $this->assertEquals($user->name, 'Mohamed Elatfi');
        $this->assertEquals($user->email, 'mohamedelatfi@iesebre.com');
        $this->assertTrue(Hash::check(env('PRIMARY_USER_PASSWORD','123456'), $user->password));
    }

    /**
     * @test
     */
    public function create_acacha_user()
    {
        create_acacha_user();
        $user = User::where('email','sergiturbadenas@gmail.com')->first();
        $this->assertEquals($user->name, 'Sergi Tur');
        $this->assertEquals($user->email, 'sergiturbadenas@gmail.com');
        $this->assertTrue(Hash::check(env('ACACHA_USER_PASSWORD','secret'), $user->password));
    }
}

