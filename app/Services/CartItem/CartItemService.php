<?php

namespace App\Services\CartItem;

use App\Http\Requests\CartItem\CartItemCreateRequest;
use App\Http\Resources\CartItemResource;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CartItemService {
    public function index(Request $request) {
        $user_id = $request->user()->id;
        $cartItems = CartItem::where('user_id', $user_id)->get();

        return response()->json(CartItemResource::collection($cartItems));
    }

    public function store(CartItemCreateRequest $request): JsonResponse {
        $validated = $request->validated();
        $user_id = $request->user()->id;
        $product_id = $validated['product_id'];
        $quantity = $validated['quantity'];

        $cartItem = CartItem::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();

        if ($cartItem) {
            if ($quantity === 0) {
                $cartItem->delete();
                return response()->json(
                    ['cart_item' => new CartItemResource($cartItem)]
                );
            } else {
                $cartItem->update(['quantity' => $quantity]);
                return response()->json(
                    ['cart_item' => new CartItemResource($cartItem->fresh())]
                );
            }
        }

        $newCartItem = [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'user_id' => $user_id,
        ];

        $cartItem = CartItem::create($newCartItem);
        return response()->json(new CartItemResource($cartItem->fresh()));
    }

    public function destroy(Request $request) {
        $user_id = $request->user()->id;
        $removeIds = $request->input('ids');

       $countRemove = CartItem::where('user_id', $user_id)
            ->whereIn('id', $removeIds)
            ->delete();

        return response()->json([
            '$removeIds' => $removeIds,
            '$countRemove' => $countRemove
        ]);
    }

    public function removeAll(Request $request) {
        $user_id = $request->user()->id;
        $countCartItemRemove = CartItem::where('user_id', $user_id)->delete();

        return response()->json(['countCartItemRemove' => $countCartItemRemove]);
    }
}
