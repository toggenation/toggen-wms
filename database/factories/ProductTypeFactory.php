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
            'storage_temperature' => $this->faker->randomElement([5, 2, 30]),
            'location_id' => null,
            'enable_pick_app' => false
        ];
    }
}
