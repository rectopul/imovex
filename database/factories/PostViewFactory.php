<?php

namespace Database\Factories;

use App\Models\PostView;
use App\Models\Post;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PostView::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id' => Post::inRandomOrder()->first()->id,
            'visitor_id' => Visitor::inRandomOrder()->first()->id,
            'viewed_at' => $this->faker->dateTimeThisYear()
        ];
    }
}
