<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory {
    public $model = Product::class;

    public function definition(): array {
        $price = $this->faker->randomFloat(2, 1, 1000);
        $discountPercentage = $this->faker->optional()->numberBetween(1, 100);
        $discountedPrice = $discountPercentage ? $price * (1 - $discountPercentage / 100) : null;
        $categoryId = Category::inRandomOrder()->first()->id ?? Category::factory(1)->create()->id;

        return [
            'name' => $this->faker->word(),
            'price' => $price,
            'brand' => $this->faker->word(),
            'category_id' => $categoryId,
            'weight_or_volume' => $this->faker->numberBetween(100, 1000),
            'country_of_manufacture' => $this->faker->country(),
            'stock' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->sentence(),
            'image_url' => $this->faker->imageUrl(),
            'discounted_price' => $discountedPrice,
            'discount_percentage' => $discountPercentage,
        ];
    }
}
