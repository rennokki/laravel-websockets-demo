<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['email' => 'user1@test.com', 'name' => 'User 1']);
        User::factory()->create(['email' => 'user2@test.com', 'name' => 'User 2']);
    }
}
