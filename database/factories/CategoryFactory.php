<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory {
    public $model = Category::class;

    public function definition(): array {
        return [
            'name' => 'category: '.$this->faker->word(),
        ];
    }
}
