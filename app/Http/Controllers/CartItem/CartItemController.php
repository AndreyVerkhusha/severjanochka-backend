<?php

namespace App\Http\Controllers\CartItem;

use App\Http\Requests\CartItem\CartItemCreateRequest;
use App\Services\CartItem\CartItemService;

class CartItemController {
    public $cartItemService;

    public function __construct(CartItemService $cartItemService) {
        $this->cartItemService = $cartItemService;
    }

    public function index() {
        return $this->cartItemService->index();
    }

    public function store(CartItemCreateRequest $request) {
        return $this->cartItemService->store($request);
    }
}
