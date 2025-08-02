<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FontMaster;
use App\Models\Product;
use App\Models\ProductColourMaster;
use App\Models\ProductColours;
use App\Models\ProductFonts;
use App\Models\ProductImageGallery;
use App\Models\ProductInsideTexts;
use App\Models\ProductVariant;
use App\Models\SubCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\OrderProduct;


class ProductController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::all();
        // $subCategories = SubCategory::all();
        // $childCategories = ChildCategory::all();
        // $brands = Brand::all();

        $categories = Category::where('status',1)->get();
        $brands = Brand::where('status',1)->get();

        $fonts = FontMaster::where(FontMaster::STATUS,1)->get([FontMaster::ID, FontMaster::FONT_NAME, FontMaster::FONT_SAMPLE_IMAGE]);
        $colours = ProductColourMaster::where(ProductColourMaster::STATUS,1)->get([ProductColourMaster::ID, ProductColourMaster::COLOUR_NAME, ProductColourMaster::COLOUR_SAMPLE_IMAGE]);

        return view('admin.product.create', compact('categories','brands', 'fonts', 'colours'));
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inside_text_type = implode(",", array_keys(Product::INSIDE_TEXT_TYPES));
        // Validate the incoming data
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200', 'unique:products,name'],
            'category' => ['required'],
            'sub_category' => ['required'],
            'child_category' => ['required'],
            'brand' => ['required'],
            'price' => ['required', 'numeric', 'gte:0'],
            'qty' => ['required', 'numeric', 'gte:0'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required', 'in:0,1'],
            'product_certificate' => ['nullable', 'file', 'mimes:pdf', 'max:10000'], // Validation for PDF upload
            'take_name' => ['nullable', 'in:yes'],
            'length' => ['nullable', 'numeric', 'gte:0'],
            'breadth' => ['nullable', 'numeric', 'gte:0'],
            'height' => ['nullable', 'numeric', 'gte:0'],
            'weight' => ['nullable', 'numeric', 'gte:0'],
            'hsn_code' => ['nullable', 'string', 'max:50'],
            'product_type' => ['nullable', 'in:new_arrival,featured_product,top_product,best_product,latest_product,best_seller_product'],
            'product_font' => ['nullable', 'array'],
            'product_font.*' => ['nullable', 'exists:fonts,id'],
            'product_colour' => ['nullable', 'array'],
            'product_colour.*' => ['nullable', 'exists:colours,id'],
        ]);

        // Handle the image upload
        $imagePath = $this->uploadImage($request, 'image', 'uploads');

        $certificatePath = null;
        if ($request->hasFile('product_certificate')) {
            $certificatePath = 'uploads/product_certificates/' . $request->file('product_certificate')->getClientOriginalName();
        
            // Move the file to the public/uploads/ directory
            $request->file('product_certificate')->move(public_path('uploads/product_certificates'), $certificatePath);
        }
        // dd($request->all());
        // chech categories min quantity
        $category_quantity = Category::where('id',$request->category)->value('min_quantity');
        if($request->qty < $category_quantity)
        {
            return redirect()->back()->with('message','Stock quantity is less than of selected categorories minimum quantity');
        }

        // Create a new product instance and assign values
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
        $product->is_approved = 1;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->take_name = $request->take_name == 'yes' ? true : false;
        $product->length = $request->length;
        $product->breadth = $request->breadth;
        $product->height = $request->height;
        $product->weight = $request->weight;
        $product->hsn_code = $request->hsn_code;
        $product->product_certificate = $certificatePath; // Store the product certificate

        // store address for map 
        $product->from_address = $request->from_address;
        $product->to_address = $request->to_address;

        // Save the product
        $product->save();

        // Handle fonts and colors relationship
        if ($request->has('product_font')) {
            $product->fonts()->sync($request->product_font);
        }

        if ($request->has('product_colour')) {
            $product->colours()->sync($request->product_colour);
        }

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.products.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $product->sub_category_id)->get();
        $categories = Category::all();
        $brands = Brand::all();
        // $productColours = ProductColours::where([ProductColours::PRODUCT_ID, $id])
        //     ->where([ProductColours::STATUS, 1])->pluck(ProductColours::COLOUR_MASTER_ID)->toArray();

        // $fonts = FontMaster::where(FontMaster::STATUS, 1)->get([FontMaster::ID, FontMaster::FONT_NAME, FontMaster::FONT_SAMPLE_IMAGE]);
        // $colours = ProductColourMaster::where(ProductColourMaster::STATUS, 1)->get([ProductColourMaster::ID, ProductColourMaster::COLOUR_NAME, ProductColourMaster::COLOUR_SAMPLE_IMAGE]);
        // $productFonts = ProductFonts::where([ProductFonts::PRODUCT_ID, $id])
        //     ->where([ProductFonts::STATUS, 1])->pluck(ProductFonts::FONT_ID)->toArray();

        return view('admin.product.edit', compact('product', 'categories', 'brands', 'subCategories', 'childCategories',));
    }

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated!']);
    }

    public function destroy(string $id)
    {
        // dd("here");
        $product = Product::findOrFail($id);
        if(OrderProduct::where('product_id',$product->id)->count() > 0){
            return response(['status' => 'error', 'message' => 'This product have orders can\'t delete it.']);
        }

        /** Delte the main product image */
        $this->deleteImage($product->thumb_image);

        /** Delete product gallery images */
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach($galleryImages as $image){
            $this->deleteImage($image->image);
            $image->delete();
        }

        /** Delete product variants if exist */
        $variants = ProductVariant::where('product_id', $product->id)->get();

        foreach($variants as $variant){
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inside_text_type = implode(",", array_keys(Product::INSIDE_TEXT_TYPES));

        // Validate the incoming data
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200', Rule::unique('products')->ignore($id, 'id')],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required'],
            'product_certificate' => ['nullable', 'file', 'mimes:pdf', 'max:10000'], // Validation for PDF upload
            'length' => ['nullable', 'numeric', 'gte:0'],
            'breadth' => ['nullable', 'numeric', 'gte:0'],
            'height' => ['nullable', 'numeric', 'gte:0'],
            'weight' => ['nullable', 'numeric', 'gte:0'],
            'hsn_code' => ['nullable', 'string', 'max:50'],
        ]);

        // Find the product to update
        $product = Product::findOrFail($id);

        // Handle image upload if a new image is uploaded
        $imagePath = $this->updateImage($request, 'image', 'uploads', $product->thumb_image);

       // Handle the product certificate (PDF) upload
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


        // Update the product fields
        $product->thumb_image = !empty($imagePath) ? $imagePath : $product->thumb_image;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
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
        $product->status = $request->status;
        $product->seo_title = $request->seo_title;
        $product->seo_description = $request->seo_description;
        $product->length = $request->length;
        $product->breadth = $request->breadth;
        $product->height = $request->height;
        $product->weight = $request->weight;
        $product->hsn_code = $request->hsn_code;
        $product->product_certificate = $certificatePath; // Store the product certificate

        $product->from_address = $request->from_address;
        $product->to_address = $request->to_address;
        // Save the updated product
        $product->save();

        toastr('Updated Successfully!', 'success');

        return redirect()->route('admin.products.index');
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = SubCategory::where('category_id', $request->id)->get();

        return $subCategories;
    }

    public function getChildCategories(Request $request)
    {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();

        return $childCategories;
    }
}
