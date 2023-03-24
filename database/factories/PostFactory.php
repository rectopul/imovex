<?php

namespace Database\Factories;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cover' => 'blog/post-'.rand(1, 5).'.png',
            'title' => ucwords($this->faker->words(rand(3, 7), true)),
            'description' => $this->faker->text(100),
            'body' => $this->faker->paragraphs(3, true),
            'publish' => rand(0, 100) % 2 === 0 ? $this->faker->dateTimeBetween('-2 years')->format('d/m/Y') : null
        ];
    }
}
