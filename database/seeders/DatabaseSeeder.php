<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $categories = Category::factory(10)->create();
        $products   = Product::factory(10)->create();
        $users      = User::factory(5)->create();

        foreach ($users as $user) {
            $randomFavorite = $products->random(rand(1, 5));
            $user->favorites()->attach($randomFavorite);
        }
    }
}
