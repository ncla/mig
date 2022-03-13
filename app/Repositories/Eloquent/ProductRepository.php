<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function get($limit = 10, $priceSort = null | 'desc' | 'asc'): Collection
    {
        return Product::limit($limit)
            ->orderBy('price_with_tax', $priceSort)
            ->get();
    }

    public function create(array $data): EloquentModel | Product
    {
        return Product::create($data);
    }
}