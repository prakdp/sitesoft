<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Тест создания пользователя
     *
     * @return void
     */
    public function testCreateUser()
    {
        factory(User::class)->create([
            'username' => 'tester',
        ]);

        $this->assertDatabaseHas('users', [
            'username' => 'tester'
        ]);
    }

    /**
     * Тест получения пользователя
     *
     * @return void
     */
    public function testGetUser()
    {
        factory(User::class)->create([
            'username' => 'tester',
        ]);
        $user = User::where('username', 'tester')->first();

        $this->assertNotNull($user);
        $this->assertEquals('tester', $user->username);
    }

    /**
     * Тест обновления пользователя
     *
     * @return void
     */
    public function testUpdateUser()
    {
        factory(User::class)->create([
            'username' => 'tester',
        ]);

        User::where('username', 'tester')->update(['username' => 'newusername']);

        $this->assertDatabaseMissing('users', [
            'username' => 'tester'
        ]);
        $this->assertDatabaseHas('users', [
            'username' => 'newusername'
        ]);
    }

    /**
     * Тест удаления пользователя
     *
     * @return void
     */
    public function testDeleteUser()
    {
        factory(User::class)->create([
            'username' => 'tester',
        ]);

        User::where('username', 'tester')->delete();

        $this->assertSoftDeleted('users', [
            'username' => 'tester'
        ]);
    }
}
