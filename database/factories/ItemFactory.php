<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\ProductType;
use App\Models\UnitsOfMeasure;
use App\Services\Barcode;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $productType = ProductType::inRandomOrder()->first();
        $ean13 =  $this->faker->ean13();
        $ean14 = "1" . substr($ean13, 0, 12);
        $ean14 .= (new Barcode)->checkDigit($ean14);

        return [
            //id, 
            "active" => $this->faker->randomElement([0, 1]),
            "code" => $this->faker->numerify('######'),
            'description' => $this->faker->words(3, true),
            'quantity' => $this->faker->numberBetween(40, 175),
            'trade_unit_barcode' =>   $ean14,
            'consumer_unit_barcode' => $ean13,
            'product_type_id' => $productType->id,
            'brand' => $this->faker->word(),
            'brand' => $this->faker->word(),
            'variant' => $this->faker->word(),
            'unit_net_contents' => $this->faker->randomElement([375, 200, 700, 500]),
            'unit_of_measure_id' => UnitsOfMeasure::factory(),
            'days_life' => $this->faker->randomElement([90, 173, 274, 365, 730]),
            'min_days_life' => 90,
            'comment' => $this->faker->paragraph(2),
            //
        ];
    }
}
