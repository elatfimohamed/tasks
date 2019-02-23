<?php

namespace Test\Unit;

use App\Mail\TestDinamicEmail;
use App\Mail\TestEmail;
use App\Mail\TestTextEmail;
use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase {

  //  use RefreshDatabase;

    /**
     * @test
     */
    public function send_markdown_email()
    {
        Mail::fake();
        //dump(env('MAIL_DRIVER'));
        $user = factory(User::class)->create();

        Mail::to($user)->send(new TestEmail());

        Mail::assertSent(TestEmail::class);
    }

    /**
     * @test
     */
    public function send_markdown_email_dinamic()
    {
        Mail::fake();
        //(env('MAIL_DRIVER'));
        $user = factory(User::class)->create();

        Mail::to($user)->send(new TestDinamicEmail($user));

        Mail::assertSent(TestDinamicEmail::class);
    }

    /**
     * @test
     */
    public function send_test_email()
    {
        Mail::fake();
        //dump(env('MAIL_DRIVER'));
        $user = factory(User::class)->create();

        Mail::to($user)->send(new TestTextEmail());

        Mail::assertSent(TestTextEmail::class);
    }
}
