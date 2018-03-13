<?php

namespace Tests\Unit;

use App\Message;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Тест создания сообщения
     *
     * @return void
     */
    public function testCreateMessage()
    {
        factory(User::class)
            ->create([
                'username' => 'Tester'
            ])
            ->each(function ($u) {
                $u->messages()->save(factory(Message::class)->make(['message' => 'test']));
            });

        $user = User::first();

        $this->assertDatabaseHas('messages', [
            'message' => 'test',
            'user_id' => $user->id
        ]);
    }

    /**
     * Тест получения всех сообщений
     *
     * @return void
     */
    public function testGetMessages()
    {
        factory(User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->messages()->saveMany(factory(Message::class, 5)->make());
            });

        $count = Message::count();

        $this->assertEquals(15, $count);
    }

    /**
     * Тест получения сообщения по идентификтаору пользователя
     *
     * @return void
     */
    public function testGetMessageByUserId()
    {
        factory(User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->messages()->saveMany(factory(Message::class, 5)->make());
            });

        $user = User::first();
        $count = Message::where('user_id', $user->id)->count();

        $this->assertEquals(5, $count);
    }

    /**
     * Тест получения сообщения через связи пользователя
     *
     * @return void
     */
    public function testGetMessageByRelations()
    {
        factory(User::class, 3)
            ->create()
            ->each(function ($u) {
                $u->messages()->saveMany(factory(Message::class, 5)->make());
            });

        $user = User::first();
        $count = $user->messages()->count();

        $this->assertEquals(5, $count);
    }

}
