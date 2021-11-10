<?php

namespace Database\Factories;

use App\Models\PrintTemplate;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrintTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PrintTemplate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(4),
            'template' => $this->faker->word() . '.' . $this->faker->fileExtension(), // glabels, nicelabels, cablabel
            'image' => $this->faker->word() . '.png',
            'show_in_ui' => $this->faker->randomElement([true, false]),
            'print_class' => 'App\Toggen\Print\Templates',
        ];
    }
}
