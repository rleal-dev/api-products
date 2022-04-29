<?php

namespace Database\Factories;

use Domain\Product\Models\Product;
use Domain\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Model>
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
            'description' => $this->faker->name(),
            'category_id' => Category::factory(),
            'dimensions' => $this->faker->name(),
            'code' => $this->faker->numerify('ABC-#####'),
            'reference' => $this->faker->numerify('XYZ-#####'),
            'quantity_stock' => $this->faker->randomNumber(2),
            'price' => $this->faker->randomFloat(2),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
