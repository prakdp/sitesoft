<?php

use App\Message;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create()->each(function (User $u) {
            $u->messages()->saveMany(factory(Message::class, rand(5, 10))->make());
        });
    }
}
