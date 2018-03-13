<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест открытия страницы авторизации
     *
     * @return void
     */
    public function testGetOpenLoginPage()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Авторизация');
    }

    /**
     * Тест авторизации с верным пользователем
     *
     * @return void
     */
    public function testLoginWithCorrectCredentials()
    {
        factory(User::class)->create([
            'username' => 'tester',
        ]);
        $response = $this->call('POST', '/login', ['username' => 'tester', 'password' => 'secret']);
        $this->followRedirects($response)
                ->assertSee('Отправить сообщение');
    }

    /**
     * Тест авторизации с неверным пользователем
     *
     * @return void
     */
    public function testLoginWithWrongCredentials()
    {
        factory(User::class)->create([
            'username' => 'tester',
        ]);
        $this->call('POST', '/login', ['username' => 'tester', 'password' => 'secret2']);
        $response = $this->call('GET', '/login');
        $response->assertSee('Вход в систему с указанными данными невозможен');
    }

}
