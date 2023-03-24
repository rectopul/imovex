<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Post, User, PostCategory};

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::factory()
        ->count(100)
        ->for(User::first())
        ->hasComments(5)
        ->create();

        Post::all()->each(function($post){
            $post->categories()->attach(PostCategory::take(rand(1, 3))->get());
        });

        Post::inRandomOrder()
        ->where('publish', '!=', null)
        ->first()
        ->update([
            'highlight' => true
        ]);

        Post::inRandomOrder()
        ->where('publish', '!=', null)
        ->limit(8)
        ->update([
            'at_home' => true
        ]);

    }
}
