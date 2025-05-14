<?php

namespace App\Http\Filters\Product;

use App\Http\Filters\AbstractFilter;
use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter {
    public const CATEGORY = 'category';

    protected function getCallbacks(): array {
        return [
            self::CATEGORY => [$this, 'getCategory'],
        ];
    }

    public function getCategory(Builder $builder, string $value) {
        $builder->where('category_id', $value);
    }
}
