<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrintTemplateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Model::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(6),
            'template' => $this->faker->word() . '.' . $this->faker->fileExtension(), // glabels, nicelabels, cablabel
            'image' => 'sample.png',
            'show_in_ui' => true,
            'print_class' => 'App\Toggen\Print\Templates',
        ];
    }
}
