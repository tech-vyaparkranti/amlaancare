<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\ProductImageGallery;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {

        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required'],
            'product_certificate' => ['nullable', 'file', 'mimes:pdf', 'max:10000'],
            'product_type' => ['nullable', 'in:new_arrival,featured_product,top_product,best_product,latest_product,best_seller_product'],
            // New fields validation
            'length' => ['nullable', 'numeric'],
            'breadth' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'hsn_code' => ['nullable', 'string'],
        ]);

        // Handle image upload
        $imagePath = $this->uploadImage($request, 'image', 'uploads');
        $certificatePath = null;
        if ($request->hasFile('product_certificate')) {
            $certificatePath = 'uploads/product_certificates/' . $request->file('product_certificate')->getClientOriginalName();
        
            // Move the file to the public/uploads/ directory
            $request->file('product_certificate')->move(public_path('uploads/product_certificates'), $certificatePath);
        }

        // Create product instance
        $product = new Product();
        $product->thumb_image = $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->vendor->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = 0;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->product_type = $request->product_type;

         // store address for map 
         $product->from_address = $request->from_address;
         $product->to_address = $request->to_address;

        // New fields for dimensions and HSN code
        $product->length = $request->length;
        $product->breadth = $request->breadth;
        $product->height = $request->height;
        $product->weight = $request->weight;
        $product->hsn_code = $request->hsn_code;

        $product->save();

        toastr('Created Successfully!', 'success');

        return redirect()->route('vendor.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Not implemented
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);

        // Check if it's the owner of the product
        if ($product->vendor_id != Auth::user()->id) {
            abort(404);
        }

        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $categories = Category::all();
        $brands = Brand::all();

        return view('vendor.product.edit', compact('product', 'subCategories', 'childCategories', 'categories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required'],
            // New fields validation
            'length' => ['nullable', 'numeric'],
            'breadth' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'weight' => ['nullable', 'numeric'],
            'hsn_code' => ['nullable', 'string'],
            'product_certificate' => ['nullable', 'file', 'mimes:pdf', 'max:10000']
        ]);

        $product = Product::findOrFail($id);

        // Check if it's the owner of the product
        if ($product->vendor_id != Auth::user()->id) {
            abort(404);
        }

        // Handle image upload
        $imagePath = $this->updateImage($request, 'image', 'uploads', $product->thumb_image);
        $certificatePath = $product->product_certificate;

        if ($request->hasFile('product_certificate')) {
            // Delete the old certificate if it exists
            if ($product->product_certificate) {
                $oldFilePath = public_path($product->product_certificate); // Get the full path
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); 
                }
            }
            $fileName = time() . '_' . $request->file('product_certificate')->getClientOriginalName();
        
            // Define the new certificate path (in public/uploads/product_certificates/)
            $certificatePath = 'uploads/product_certificates/' . $fileName;
        
            // Move the new certificate to the public/uploads/product_certificates/ directory
            $request->file('product_certificate')->move(public_path('uploads/product_certificates'), $certificatePath);
        }
        
        
        
        $product->product_certificate = $certificatePath;
        $product->thumb_image = empty($imagePath) ? $product->thumb_image : $imagePath;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->vendor_id = Auth::user()->id;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category;
        $product->child_category_id = $request->child_category;
        $product->brand_id = $request->brand;
        $product->qty = $request->qty;
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->video_link = $request->video_link;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->offer_start_date = $request->offer_start_date;
        $product->offer_end_date = $request->offer_end_date;
        $product->product_type = $request->product_type;
        $product->status = $request->status;
        $product->is_approved = $product->is_approved;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;

        // New fields for dimensions and HSN code
        $product->length = $request->length;
        $product->breadth = $request->breadth;
        $product->height = $request->height;
        $product->weight = $request->weight;
        $product->hsn_code = $request->hsn_code;
        $product->from_address = $request->from_address;
        $product->to_address = $request->to_address;
        $product->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('vendor.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        if ($product->vendor_id != Auth::user()->id) {
            abort(404);
        }

        // Delete the main product image
        $this->deleteImage($product->thumb_image);

        // Delete product gallery images
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach ($galleryImages as $image) {
            $this->deleteImage($image->image);
            $image->delete();
        }

        // Delete product variants if exist
        $variants = ProductVariant::where('product_id', $product->id)->get();
        foreach ($variants as $variant) {
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    /**
     * Change product status (Active/Inactive)
     */
    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated!']);
    }

    /**
     * Get all product subcategories based on category
     */
    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->get();
        return $subCategories;
    }

    /**
     * Get all product child categories based on subcategory
     */
    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();
        return $childCategories;
    }
}
