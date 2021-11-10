<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            //id, location, capacity, hidden, description, product_type_id, created_at, updated_at
            'name' => $this->faker->word(),
            'capacity' => $this->faker->randomElement([1, 2, 3, 4]),
            'hidden' => false,
            'description' => $this->faker->words(3, true),
            'product_type_id' => function () {
                return ProductType::factory()->create()->id;
            }

        ];
    }
}
