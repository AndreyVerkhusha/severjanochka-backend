<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller {
    public $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }

    public function index(ProductRequest $request) {
        return $this->productService->index($request);
    }
}
