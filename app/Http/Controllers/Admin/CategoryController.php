<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'page' => 'categories',
            'categories' => Category::with('children')->whereNull('parent_id')->get(),
        ];

        return view('admin.contents.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'page' => 'categories',
        ];
        return view('admin.contents.category.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->slug = $request->get('slug');
        $category->save();
        return redirect('category')
            ->withSuccess(Lang::get('category.alert.success.create'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data = [
            'page' => 'categories',
            'category' => $category,
        ];
        return view('admin.contents.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
        ]);
        return redirect()
            ->route('category.index')
            ->withSuccess(Lang::get('category.alert.success.edit'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('category')->withSuccess(Lang::get('category.alert.success.delete'));
    }
}
