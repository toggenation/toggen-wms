<?php

namespace Database\Factories;

use App\Models\UnitsOfMeasure;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitsOfMeasureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UnitsOfMeasure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $unitsOfMeasure = ['ML', 'PL', 'EA', 'CTN', 'BOX', 'TUB'];
        $item = $this->faker->randomElement($unitsOfMeasure);
        return [
            //
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(4),
            'short_name' => $this->faker->slug(1),
            'inventory_uom' => true
        ];
    }
}
