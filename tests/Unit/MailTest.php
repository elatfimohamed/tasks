<?php

namespace Test\Unit;

use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class MailTest extends TestCase {

    /**
     * @test
     */
    public function send_email()
    {
        $user = factory(User::class)->create();
        //2
        Mail::to($user)->send(new TestEmail());

    }






}