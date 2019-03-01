<?php

// PSR-4
namespace Tests\Feature;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    /**
     * @test
     */
    public function guest_user_cannot_index_tags()
    {
        $response = $this->get('/tags');
        $response->assertRedirect('login');
    }

    /**
     * @test
     */
    public function regular_user_cannot_index_tags()
    {
        $this->login();
        $response = $this->get('/tags');
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function superadmin_can_index_tags()
    {
        //$this->withExceptionHandling();
        create_example_tags();

        $user = $this->loginAsSuperAdmin();
        $response = $this->get('/tags');
        $response->assertSuccessful();
        $response->assertViewIs('tags');
        $response->assertViewHas('tags', function ($tags) {
            return count($tags) === 3;
        });
    }

    /**
     * @test
     */
    public function tag_manager_can_index_tags()
    {
        create_example_tags();

        $this->loginAsTagsManager();
        $response = $this->get('/tags');
        $response->assertSuccessful();
        $response->assertViewIs('tags');
        $response->assertViewHas('tags', function ($tags) {
            return count($tags) === 3;
        });
    }

    /**
     * @test
     */
    public function tags_user_cannot_index_tags()
    {
        $user = $this->loginAsUsingRole('web','Tags');

        $tag = Tag::create([
            'name' => 'Tasca usuari logat',
            'description' => 'Jorl',
            'color' => 'red'
        ]);
        $this->assertNotNull($user);
        $this->assertNotNull($tag);
        $response = $this->get('/tags');
        $response->assertStatus(403);
    }
}