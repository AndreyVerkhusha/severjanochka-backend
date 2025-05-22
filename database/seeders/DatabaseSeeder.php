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
        $products = Product::factory(10)->create();
        $users = User::factory(5)->create();
        $ratingProducts = $products->random(rand(1, 7));

        foreach ($users as $user) {
            $randomProducts = $products->random(rand(1, 5));
            $user->favorites()->attach($randomProducts);

            foreach ($randomProducts as $product) {
                $user->cartItems()->create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 3)
                ]);

                $commentCount = rand(1, 3);
                $randomRating = rand(1, 5);

                $product->ratings()->create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'rating' => $randomRating,
                ]);

                for ($i = 0; $i < $commentCount; $i++) {
                    $product->comments()->create([
                        'user_id' => $user->id,
                        'product_id' => $product->id,
                        'text' => 'Это рандомный комментарий #' . ($i + 1) . ' для продукта ' . $product->id . 'Пользователем: ' . $user->id,
                    ]);
                }
            }
        }

        foreach ($ratingProducts as $productToRate) {
            $productToRate->ratings()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'product_id' => $productToRate->id,
                    'rating' => rand(1, 5)
                ]
            );
        }
    }
}
