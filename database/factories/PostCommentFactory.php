<?php

namespace Database\Factories;

use App\Models\PostComment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'body' => $this->faker->paragraphs(rand(1,2), true),
            'status' => $this->faker->randomElement(['AP', 'BL', null])
        ];
    }
}
