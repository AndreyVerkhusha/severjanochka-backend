<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\User;
use App\Services\ProductService;
use Request;

class ProductController extends Controller {
    public $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index(ProductRequest $request) {
        return $this->productService->index($request);
    }

    public function rate(Request $request, $product) {
        return $this->productService->rate($request, $product);
    }
}
