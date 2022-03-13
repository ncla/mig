<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model as EloquentModel;
use Illuminate\Support\Collection;

class ProductRepository
{
    /**
     * @param $limit int Record amount to return
     * @param string|null $priceSort "asc" or "desc" order values, null for no ordering
     * @return Collection
     */
    public function get(int $limit = 10, null | string $priceSort = null): Collection
    {
        $query = Product::limit($limit);

        if ($priceSort !== null) {
            $query = $query->orderBy('price_with_tax', $priceSort);
        }

        return $query->get();
    }

    /**
     * @param array $data
     * @return EloquentModel|Product
     */
    public function create(array $data): EloquentModel | Product
    {
        return Product::create($data);
    }
}