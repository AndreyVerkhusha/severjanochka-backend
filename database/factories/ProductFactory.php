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
        $price              = $this->faker->randomFloat(2, 1, 1000);
        $discountPercentage = $this->faker->optional()->numberBetween(1, 100);
        $discountedPrice    = $discountPercentage ? $price * (1 - $discountPercentage / 100) : null;
        $categoryId         = Category::inRandomOrder()->first()->id ?? Category::factory(1)->create()->id;

        return [
            'name'                => $this->faker->word(),
            'description'         => $this->faker->sentence(),
            'price'               => $price,
            'stock'               => $this->faker->numberBetween(1, 100),
            'image_url'           => $this->faker->imageUrl(),
            'discounted_price'    => $discountedPrice,
            'discount_percentage' => $discountPercentage,
            'category_id'         => $categoryId,
        ];
    }
}
