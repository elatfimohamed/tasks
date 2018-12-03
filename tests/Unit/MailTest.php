<?php

namespace Test\Unit;

use App\Mail\TestDinamicEmail;
use App\Mail\TestEmail;
use App\Mail\TestTextEmail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase {

    /**
     * @test
     */
    public function send_markdown_email()
    {
        $user = factory(User::class)->create();

        Mail::to($user)->send(new TestEmail());
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function send_email()
    {
        // 1
        $user = factory(User::class)->create();

        // 2
        Mail::to($user)->send(new TestTextEmail());
        $this->assertTrue(true);

    }
    /**
     * @test
     */
    public function send_markdown_dinamic_email()
    {
        // 1
        $user = factory(User::class)->create();

        // 2
        Mail::to($user)->send(new TestDinamicEmail($user));
        $this->assertTrue(true);



    }
}