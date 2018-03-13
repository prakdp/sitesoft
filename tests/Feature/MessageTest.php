<?php

namespace Tests\Feature;

use App\Message;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MessageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест получения пустой стены сообщений
     *
     * @return void
     */
    public function testGetMessagesFree()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Стена сообщений пуста :(');
    }

    /**
     * Тест получения не пустой стены сообщений
     *
     * @return void
     */
    public function testGetMessages()
    {
        factory(User::class)
            ->create([
                'username' => 'Tester'
            ])
            ->each(function ($u) {
                $u->messages()->save(factory(Message::class)->make(['message' => 'I\'m test message']));
            });

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('I\'m test message');
        $response->assertDontSee('Стена сообщений пуста :(');
    }

    /**
     * Тест отправления некорректного сообщения
     *
     * @return void
     */
    public function testCreateWrongMessage()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $response = $this->post('/messages');
        $this->followRedirects($response)
                ->assertSee('Сообщение не может быть пустым');
    }

    /**
     * Тест отправления корректного сообщения
     *
     * @return void
     */
    public function testCreateMessage()
    {
        $user = factory(User::class)->create(['username' => 'tester']);
        $this->actingAs($user);

        $response = $this->post('/messages', ['message' => 'I\'m test message']);
        $this->followRedirects($response)
                ->assertSee('<h5>tester</h5>')
                ->assertSee('I\'m test message');
    }
}
