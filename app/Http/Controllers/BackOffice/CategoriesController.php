<?php

namespace App\Http\Controllers\BackOffice;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('searchString')) {
            $searchString = $request->get('searchString');
            $categories = Category::where('name', 'like', "%$searchString%")->paginate(10);
        } else {
            $categories = Category::paginate(10);
        }

        if ($request->ajax()) {
            return $categories;
        } else {
            return view('back-office.categories.index', compact('categories')); 
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-office.categories.create');
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
            'name' => 'required|max:200',
            'description' => 'required',
        ]);
        
        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        if ($request->icon) {
            $file = $request->file('icon');
            $category->icon_path = Storage::putFile('public/categories', $file);
        }

        $category->save();

        return redirect(route('back-office.categories.index'))
            ->with(['status' => 'Category created!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('back-office.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:200',
            'description' => 'required',
        ]);
        $category->fill($request->all());
        if ($request->icon) {
            if (Storage::exists($category->icon_path)) {
                Storage::delete($category->icon_path);
            }
            $category->icon_path = $request->file('icon')->store('public/categories');
        }
        $category->save();
        return redirect(route('back-office.categories.index'))
            ->with(['status' => 'Category saved!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (Storage::exists($category->icon_path)) {
            Storage::delete($category->icon_path);
        }
        $category->delete();
        return redirect(route('back-office.categories.index'))
            ->with(['status' => 'Category deleted!']);
    }
}
