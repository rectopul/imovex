<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Visitor;
use App\Models\PropertyView;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyViewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PropertyView::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'property_id' => Property::on('pgsql')->inRandomOrder()->first()->id,
            'visitor_id' => Visitor::inRandomOrder()->first()->id,
            'viewed_at' => $this->faker->dateTimeThisYear()
        ];
    }
}
