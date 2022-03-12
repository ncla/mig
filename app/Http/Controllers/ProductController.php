<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('products');
    }

    public function create(Request $request, ProductRepository $productRepository)
    {
        $productRepository->create($request->all());

        return redirect('/')->with('success', true);
    }
}
