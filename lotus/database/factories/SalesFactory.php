<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sales::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numerify('###.##'),
            'profit' => $this->faker->numerify('###.##')
        ];
    }
}
