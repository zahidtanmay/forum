<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    function a_user_can_browse_threads(){

        $this->get('/threads')
            ->assertSee($this->thread->title);

    }

    /** @test */
    function a_user_can_read_a_single_thread(){

        $this->get('/threads/'.$this->thread->id)
            ->assertSee($this->thread->title);
    }

    /** @test */
    function a_user_can_read_replies_that_are_associated_with_a_thread(){
        $reply = factory('App\Reply')->create(['thread_id' => $this->thread->id]);

        $this->get('/threads/'.$this->thread->id)->assertSee($reply->body);
    }
}
