<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->admin()->create([
            'name' => 'Stefan',
            'email' => 'litewebapp@gmail.com',
            'password' => Hash::make('stefan1989')
        ]);

        $authors = User::factory(5)->author()->create();

        Post::factory(20)->recycle($authors)->create();
    }
}
