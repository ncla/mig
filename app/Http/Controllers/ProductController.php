<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function index(Request $request)
    {
        $priceSortingQuery = $request->get('sortPrice');
        $priceSorting = in_array($priceSortingQuery, ['asc', 'desc']) ? $priceSortingQuery : null;

        return view('products', [
            'products' => $this->productRepository->get(priceSort: $priceSorting)
        ]);
    }

    public function create(Request $request)
    {
        $this->productRepository->create($request->all());

        return redirect('/')->with('success', true);
    }
}
