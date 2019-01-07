<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return dd('index');
        $categories = Category::paginate(50);
        return view ('backOffice.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('backOffice.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return dd($request);
        $attributes = request()->validate([
            'name'=>['required','min:3'],
            'description'=>['required', 'min:3'],            
        ]);

        $category = Category::create($attributes);
        
        if($request->icon){
            $category->iconPath = Storage::putFile('public/categories', $request->file('icon'));
        }

        $category->save();

        return redirect('backOffice/categories')->
            with(['status'=>'Category created']);
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
    public function edit(Category $category)
    {
        return view('backOffice.categories.edit', compact('category'));
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
            'description'=>['required', 'min:3']
        ]);
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        
        if($request->iconPath){
            if(Storage::exists($category->iconPath)){
                Storage::delete($category->iconPath);
            }
            $category->iconPath = $request->file('iconPath')->
                store('/public/categories');
        }

        $category->save();
        
        return redirect('backOffice/categories')->
            with(['status'=>'Category updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return dd('destroy');
        Category::findOrFail($id)->delete();

        return redirect('backOffice/categories')->
            with(['status'=>'Category deleted']);
    }
}
