<?php

namespace Tests\Unit;

use App\User;
use Notification;
use Tests\TestCase;
use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
        parent::setUp();
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_thread_has_a_path()
    {
        $thread = create('App\Thread');

        $this->assertEquals("/threads/{$thread->channel->slug}/{$thread->slug}", $thread->path());
    }
    /** @test */
    public function a_thread_has_a_creator()
    {
        $this->assertInstanceOf(User::class, $this->thread->creator);
    }

    /** @test */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    /** @test */
    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    /** @test */
    public function a_thread_notifies_all_registerd_subscribers_when_a_reply_is_added()
    {
        Notification::fake();

        $this->signIn()
            ->thread
            ->subscribe()
            ->addReply([
                'body' => 'Foobar',
                'user_id' => 999
            ]);

        Notification::assertSentTo(auth()->user(), ThreadWasUpdated::class);
    }

    /** @test */
    public function a_thread_belongs_to_a_channel()
    {
        $thread = create('App\Thread');

        $this->assertInstanceOf('App\Channel', $thread->channel);
    }

    /** @test */
    public function a_thread_can_be_subscribed_to()
    {
        $thread = create('App\Thread');

        $this->signIn($user = User::find(1));

        $thread->subscribe();

        $this->assertEquals(
            1,
            $thread->subscriptions()->where('user_id', $user->id)->count()
        );
    }

    /** @test */
    public function a_thread_can_be_unsubscribed_from()
    {
        $thread = create('App\Thread');

        $this->signIn($user = User::find(1));

        $thread->subscribe();

        $thread->unsubscribe();

        $this->assertEquals(
            0,
            $thread->subscriptions()->where('user_id', $user->id)->count()
        );
    }

    /** @test */
    public function it_knows_if_the_authenticated_user_is_subscribed_to_it()
    {
        $thread = create('App\Thread');

        $this->signIn();

        $this->assertFalse($thread->isSubscribedTo);

        $thread->subscribe();

        $this->assertTrue($thread->isSubscribedTo);
    }

    /** @test */
    public function a_thread_can_check_is_the_authenticated_user_has_read_all_replies()
    {
        $this->signIn();

        tap(auth()->user(), function ($user) {
            $thread = create('App\Thread');

            $this->assertTrue($thread->hasUpdatesFor($user));

            $user->read($thread);

            $this->assertFalse($thread->hasUpdatesFor($user));
        });
    }

    /** @test */
    public function a_thread_body_is_sanatized_automatically()
    {
        $thread = make('App\Thread', ['body' => '<script>alert("bad")</script><p>This is okay</p>' ]);

        $this->assertEquals('<p>This is okay</p>', $thread->body);
    }
}
