<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductRepository $productRepository) {}

    public function index(Request $request)
    {
        return view('products', [
            'products' => $this->productRepository->get(priceSort: 'desc')
        ]);
    }

    public function create(Request $request)
    {
        $this->productRepository->create($request->all());

        return redirect('/')->with('success', true);
    }
}
