<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->name,
            'price' => $this->faker->numerify('##.##'),
            'code' => $this->faker->numerify('#######'),
            'sale_price' => $this->faker->numerify('##.##')
        ];
    }
}
