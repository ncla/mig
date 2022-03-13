<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(protected ProductRepository $productRepository) {}

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $priceSortingQuery = $request->input('sortPrice');
        $priceSorting = in_array($priceSortingQuery, ['asc', 'desc']) ? $priceSortingQuery : null;

        return view('products', [
            'products' => $this->productRepository->get(priceSort: $priceSorting)
        ]);
    }

    /**
     * TODO: Separate Request class with input validation
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function create(Request $request)
    {
        $this->productRepository->create($request->all());

        return redirect('/')->with('success', true);
    }
}
