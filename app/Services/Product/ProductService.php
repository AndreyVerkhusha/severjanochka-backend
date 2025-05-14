<?php

namespace App\Services\Product;

use App\Http\Filters\Product\ProductFilter;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductService {
    public function index(ProductRequest $request) {
        $dataValidated = $request->validated();
        $page          = $request->query('page', 1);
        $per_page      = $request->query('per_page', 10);

        $filter   = app()->make(ProductFilter::class, ['queryParams' => array_filter($dataValidated)]);
        $products = Product::filter($filter)->paginate($per_page, ['*'], 'page', $page);

        $data = [
            'data'          => ProductResource::collection($products->items()),
            'current_page'  => $page,
            'per_page'      => $per_page,
            'totalPage'     => $products->lastPage(),
            'totalProducts' => $products->total(),
        ];

        return response()->json($data);
    }
}
