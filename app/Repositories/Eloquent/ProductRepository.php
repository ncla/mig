<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;

class ProductRepository
{
    public function create($data)
    {
        return Product::create($data);
    }
}