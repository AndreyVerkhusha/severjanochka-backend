<?php

namespace App\Services\CartItem;

use App\Http\Requests\CartItem\CartItemCreateRequest;
use App\Models\CartItem;

class CartItemService {
    public function index() {
        return response()->json(CartItem::all());
    }

    public function store(CartItemCreateRequest $request) {
        $validated = $request->validated();

        return response()->json($validated);
    }
}
