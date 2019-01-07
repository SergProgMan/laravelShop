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

        $product = Product::create($attributes);

        if($request->image){
            $file = $request->file('image');
            $product->imagePath = Storage::putFile('/public/products', $file);
        }

        if($request->category_id){
            $category=Category::find($request->category_id);
            $product->category()->associate($category);
        }

        $product->save();

        return redirect('/backOffice/products')->
            with(['status'=>'Product created']);
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

        if($request->imagePath){
            if(Storage::exist($product->imagePath)){
                Storage::delete($product->imagePath);
            }
            $product->imagePath = $request->file('imagePath')->
                store('/public/categories');
        }

        $product->save();

        return redirect('backOffice/products')->
            with(['status'=>'Product updated']);
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

        return redirect ('backOffice/products')->
            with(['status'=>'Product deleted']);
        //return dd('destroy');
    }
}
