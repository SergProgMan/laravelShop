<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;

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
        $products = Product::paginate(50);
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
        $categories = Category::all();
        return view('backOffice.products.create', compact('categories'));
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
            'category_id' => 'required|integer',
            'name'=>['required','min:3'],
            'description'=>['required', 'min:3'],
            'price'=>['required', 'numeric'],
        ]);

        $product = new Product;
        $product->fill($request->all());
        if($request->category_id){
            $category=Category::find($request->category_id);
            $product->category()->associate($category);
        }
        return $product;
        $product->save();

        return redirect('/backOffice/products');
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
    public function update(Request $request, $id, Product $product)
    {
        $request->validate([
            'category_id' => 'integer',
            'name'=>['required','min:3'],
            'description'=>['required', 'min:3'],
            'price'=>['required', 'numeric'],
        ]);
        $product->fill($request->all());
        if($request->category_id){
            $category=Category::find($request->category_id);
            $product->category()->associate($category);
        }
        $product->save();

        return redirect('backOffice/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return redirect ('backOffice/products');
        //return dd('destroy');
    }
}
