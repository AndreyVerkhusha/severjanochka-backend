<?php

namespace App\Services\Favorite;

use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteService {
    public function index(Request $request) {
        $user      = $request->user();
        $favorites = $user->favorites()->get();

        return response()->json($favorites);
    }

    public function toggleFavorite(Request $request, string $id) {
        $user    = $request->user();
        $product = Product::find($id);

        if (! $product) {
            return response()->json(['message' => 'product not found'], 404);
        }

        if ($user->favorites()->where('product_id', $id)->exists()) {
            $user->favorites()->detach($product->id);

            return response()->json(['message' => 'Product removed from favorites']);
        } else {
            $user->favorites()->attach($product->id);

            return response()->json(['message' => 'Product added to favorites']);
        }
    }
}
