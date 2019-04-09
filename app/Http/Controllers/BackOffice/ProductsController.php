<?php

namespace App\Http\Controllers\BackOffice;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10); 
        return view('backOffice.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backOffice.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|max:200',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $product = new Product;
        $product->fill($request->all());
        if ($request->category_id) {
            $category = Category::find($request->category_id);
            $product->category()->associate($category);
        }
        $product->save();

        return redirect(route('backOffice.products.index'))
            ->with(['status' => 'Product created!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('backOffice.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'integer',
            'name' => 'max:200',
            'description' => '',
            'price' => 'numeric',
        ]);

        $product->fill($request->all());
        if ($request->category_id) {
            $category = Category::find($request->category_id);
            $product->category()->associate($category);
        }
        $product->save();

        return redirect(route('backOffice.products.index'))
            ->with(['status' => 'Product updated!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('backOffice.products.index'))
        ->with(['status' => 'Product deleted!']);
    }
}
