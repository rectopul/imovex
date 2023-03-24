<?php

namespace Database\Factories;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip_address' => $this->faker->unique()->ipv4(), 
            'user_agent' => $this->faker->userAgent(),
            'last_activity' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}
