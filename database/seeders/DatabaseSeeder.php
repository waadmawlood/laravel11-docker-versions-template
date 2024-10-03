<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $testUser = $this->createTestUser();
    }

    /**
     * Create a test user.
     */
    private function createTestUser(): ?User
    {
        return User::whereEmail('test@example.com')->doesntExist() ?

            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]) :

            User::query()->whereEmail('test@example.com')->first();
    }
}
