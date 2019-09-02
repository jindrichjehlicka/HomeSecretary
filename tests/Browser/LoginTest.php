<?php

namespace Tests\Browser;

use http\Client\Curl\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SendEmailTest extends DuskTestCase
{
    public function testEmailSending()
    {

        $ocassion = Ocassion::first();
        $mock = Mockery::mock('Swift_Mailer');
        $this->app['mailer']->setSwiftMailer($mock);
        $mock->shouldReceive('send')->once()
            ->andReturnUsing(function($msg) {
                $this->assertEquals('Occasion reminder', $msg->getSubject());
                $this->assertEquals('jindrichjehlicka@example.com', $msg->getTo());
                $this->assertContains('Occasion place', $msg->getBody());
            });
    }
}
