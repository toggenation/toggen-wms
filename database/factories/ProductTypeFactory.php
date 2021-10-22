<?php

namespace Database\Factories;

use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'default_inventory_status_id' => null,
            'active' => true,
            'name' => strtoupper($this->faker->lexify('???')),
            'code_prefix' => $this->faker->numerify('#####'),
            'storage_temperature' => $this->faker->randomElement([5, 2, 30]),
            'default_putaway_location_id' => null,
            'code_regex' => '/abc/',
            'code_regex_description' => 'Includes abc',
            'enable_pick_app' => false
        ];
    }
}
