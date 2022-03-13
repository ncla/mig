<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function get($limit = 10, null | string $priceSort = null): Collection
    {
        $query = Product::limit($limit);

        if ($priceSort !== null) {
            $query = $query->orderBy('price_with_tax', $priceSort);
        }

        return $query->get();
    }

    public function create(array $data): EloquentModel | Product
    {
        return Product::create($data);
    }
}