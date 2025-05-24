<?php

namespace App\Services;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\RateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\User;
use Request;

class ProductService {
    public function index(ProductRequest $request) {
        $dataValidated = $request->validated();
        $page = $request->query('page', 1);
        $per_page = $request->query('per_page', 10);

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($dataValidated)]);
        $products = Product::filter($filter)->paginate($per_page, ['*'], 'page', $page);

        $data = [
            'data' => ProductResource::collection($products->items()),
            'current_page' => $page,
            'per_page' => $per_page,
            'totalPage' => $products->lastPage(),
            'totalProducts' => $products->total(),
        ];

        return response()->json($data);
    }

    public function rate(RateRequest $request, $product) {
        $dataValidated = $request->validated();
        $product = Product::findOrFail($product);
        $user = $request->user();

        $product->rateProduct($user, $dataValidated['rate']);
        return response()->json($product->ratings);
    }
}
