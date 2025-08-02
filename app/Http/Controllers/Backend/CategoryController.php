<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
    */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'icon' => ['required', 'not_in:empty'],
            'category_banner' => ['nullable', 'image', 'max:2048'],
            'name' => ['required', 'max:200', 'unique:categories,name'],
            'status' => ['required'],
            'image' => ['nullable', 'image', 'max:2048'], // Validate image
        ]);

        $category = new Category();

        // Handle image upload
        if ($request->hasFile('image')) {
            $category->image = $request->file('image')->store('categories', 'public');
        }
        if ($request->hasFile('category_banner')) {
            $category->category_banner = $request->file('category_banner')->store('categories', 'public');
        }

        // $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keyword = $request->meta_keyword;
        $category->og_title = $request->og_title;
        $category->og_url = $request->og_url;
        $category->og_type = $request->og_type;
        $category->og_site_url = $request->og_site_url;
        $category->canonical = $request->canonical;
        $category->og_local = $request->og_local;
        $category->site_map = $request->site_map;
        $category->robots = $request->robots;
        $category->min_quantity = $request->min_quantity;

        $category->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        // dd($category);
        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            // 'icon' => ['required', 'not_in:empty'],
            'category_banner' => ['nullable', 'image', 'max:2048'],
            'name' => ['required', 'max:200', 'unique:categories,name,' . $id],
            'status' => ['required'],
            'image' => ['nullable', 'image', 'max:2048'], // Validate image
        ]);

        $category = Category::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if necessary
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            // if ($category->category_banner) {
            //     Storage::disk('public')->delete($category->category_banner);
            // }

            $category->image = $request->file('image')->store('categories', 'public');
            // $category->category_banner = $request->file('category_banner')->store('categories', 'public');
        }
        if ($request->hasFile('category_banner')) {
            // Delete old image if necessary
            // if ($category->image) {
            //     Storage::disk('public')->delete($category->image);
            // }
            if ($category->category_banner) {
                Storage::disk('public')->delete($category->category_banner);
            }

            // $category->image = $request->file('image')->store('categories', 'public');
            $category->category_banner = $request->file('category_banner')->store('categories', 'public');
        }

        // $category->icon = $request->icon;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->meta_title = $request->meta_title;
        $category->meta_description = $request->meta_description;
        $category->meta_keyword = $request->meta_keyword;
        $category->og_title = $request->og_title;
        $category->og_url = $request->og_url;
        $category->og_type = $request->og_type;
        $category->og_site_url = $request->og_site_url;
        $category->canonical = $request->canonical;
        $category->og_local = $request->og_local;
        $category->site_map = $request->site_map;
        $category->robots = $request->robots;
        $category->min_quantity = $request->min_quantity;

        $category->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $subCategory = SubCategory::where('category_id', $category->id)->count();

        if ($subCategory > 0) {
            return response(['status' => 'error', 'message' => 'This item contains sub-items; delete them first!']);
        }

        // Delete image if it exists
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        if ($category->category_banner) {
            Storage::disk('public')->delete($category->category_banner);
        }

        $category->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->status == 'true' ? 1 : 0;
        $category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
