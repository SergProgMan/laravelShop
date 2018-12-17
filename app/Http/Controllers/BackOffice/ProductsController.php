<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return dd('index');
        $products = Product::all();
        return view('backOffice.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return dd('create');
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
        $attributes = request()->validate([
            'name'=>['required','min:3'],
            'description'=>['required', 'min:3'],
            'price'=>['required', 'numeric'],
        ]);

        //return $attributes;
        Product::create($attributes)->save();

        return redirect('/control-panel/products');
        
        // $product = new Product;
        // $product->name = request('name');
        // $product->price = request('price');
        // $product->description = request('description');

        // $product->save();
        // //return dd('store');
        // return redirect('/control-panel/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('backOffice.products.edit', compact('product'));
        //return dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>['required','min:3'],
            'description'=>['required', 'min:3'],
            'price'=>['required', 'numeric'],
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();

        return redirect('backOffice/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return dd('destroy');
    }
}
