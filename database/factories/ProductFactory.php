<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Product>
 */
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
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'ean_13' => $this->faker->ean13(),
            'name' => $this->faker->name(),
            'quantity' => $this->faker->numberBetween(0, 1000),
            'initial_cost' => $this->faker->randomFloat(2, 0, 100),
            'price_with_tax' => $this->faker->randomFloat(2, 0, 1000)
        ];
    }
}
