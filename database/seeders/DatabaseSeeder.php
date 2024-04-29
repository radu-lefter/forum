<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $posts = Post::factory(200)
            ->withFixture()
            ->has(Comment::factory(15)->recycle($users))
            ->recycle($users)
            ->create();

        $radu = User::factory()->has(Post::factory(45)->withFixture())
            ->has(Comment::factory(120))->recycle($posts)
            ->create([
                'name' => 'Radu Bradu',
                'email' => 'radu@example.com',
            ]);
    }
}
