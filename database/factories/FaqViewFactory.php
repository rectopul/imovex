<?php

namespace Database\Factories;

use App\Models\Faq;
use App\Models\Visitor;
use App\Models\FaqView;
use Illuminate\Database\Eloquent\Factories\Factory;

class FaqViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FaqView::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'faq_id' => Faq::inRandomOrder()->first()->id,
            'visitor_id' => Visitor::inRandomOrder()->first()->id,
            'viewed_at' => $this->faker->dateTimeThisYear()
        ];
    }
}
