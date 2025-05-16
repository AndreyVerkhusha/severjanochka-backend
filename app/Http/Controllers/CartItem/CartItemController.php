<?php

namespace App\Http\Controllers\CartItem;

use App\Http\Requests\CartItem\CartItemCreateRequest;
use App\Services\CartItem\CartItemService;
use Illuminate\Http\Request;

class CartItemController {
    public $cartItemService;

    public function __construct(CartItemService $cartItemService) {
        $this->cartItemService = $cartItemService;
    }

    public function index(Request $request) {
        return $this->cartItemService->index($request);
    }

    public function store(CartItemCreateRequest $request) {
        return $this->cartItemService->store($request);
    }

    public function destroy(Request $request) {
        return $this->cartItemService->destroy($request);
    }

    public function removeAll(Request $request) {
        return $this->cartItemService->removeAll($request);
    }

}
