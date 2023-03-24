<?php

namespace Database\Factories;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($this->faker));
        $this->faker->addProvider(new \Faker\Provider\pt_BR\Person($this->faker));
        $this->faker->addProvider(new \Faker\Provider\DateTime($this->faker));
        
        return [
            'created_at' => $this->faker->dateTimeBetween('-2 years', 'now', 'America/Sao_Paulo'),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'phone' => $this->faker->phoneNumber,
            'subject' => $this->faker->word,
            'message' => $this->faker->text,
            'read' => rand(0, 100) % 2 === 0 ? Carbon::now() : null
        ];
    }
}
