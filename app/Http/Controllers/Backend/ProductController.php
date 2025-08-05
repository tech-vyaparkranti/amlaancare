<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ProductDataTable;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\FontMaster;
use App\Models\Order;
use App\Models\OrderProduct;
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
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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
        $categories = Category::all();
        $brands = Brand::all();
        
        $fonts = FontMaster::where(FontMaster::STATUS,1)->get([FontMaster::ID,FontMaster::FONT_NAME,FontMaster::FONT_SAMPLE_IMAGE]);
        $colours = ProductColourMaster::where(ProductColourMaster::STATUS,1)->get([ProductColourMaster::ID,ProductColourMaster::COLOUR_NAME,ProductColourMaster::COLOUR_SAMPLE_IMAGE]);
        
        return view('admin.product.create', compact('categories', 'brands','fonts','colours'));
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
        'sub_category' => ['nullable'],
        'child_category' => ['nullable'],
        'brand' => ['required'],
        'price' => ['required', 'numeric', 'gte:0'],
        'qty' => ['required', 'numeric', 'gte:0'],
        'short_description' => ['required', 'max:600'],
        'long_description' => ['required'],
        'seo_title' => ['nullable', 'max:200'],
        'seo_description' => ['nullable', 'max:250'],
        'status' => ['required', 'in:0,1'],
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
    
    // Check categories min quantity
    $category_quantity = Category::where('id', $request->category)->value('min_quantity');
    if ($request->qty < $category_quantity) {
        return redirect()->back()->with('message', 'Stock quantity is less than of selected categories minimum quantity');
    }

    // Create a new product instance and assign values
    $product = new Product();
    $product->thumb_image = $imagePath;
    $product->name = $request->name;
    $product->slug = Str::slug($request->name);

    // Conditionally assign the vendor_id
    if (Auth::check() && Auth::user()->vendor) {
        $product->vendor_id = Auth::user()->vendor->id;
    } else {
        // Assign the ID of a default admin vendor
        $product->vendor_id = 1; // Replace 1 with the actual ID of your admin vendor
    }

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $productColours = ProductColours::where([
            [ProductColours::PRODUCT_ID,$id],
            [ProductColours::STATUS,1]])->pluck(ProductColours::COLOUR_MASTER_ID)->toArray();
         
        $fonts = FontMaster::where(FontMaster::STATUS,1)->get([FontMaster::ID,FontMaster::FONT_NAME,FontMaster::FONT_SAMPLE_IMAGE]);
        $colours = ProductColourMaster::where(ProductColourMaster::STATUS,1)->get([ProductColourMaster::ID,ProductColourMaster::COLOUR_NAME,ProductColourMaster::COLOUR_SAMPLE_IMAGE]);
        $productFonts = ProductFonts::where([
            [ProductFonts::PRODUCT_ID,$id],
            [ProductFonts::STATUS,1]])->pluck(ProductFonts::FONT_ID)->toArray();
         
        $productInsideText = ProductInsideTexts::where([
            [ProductInsideTexts::PRODUCT_ID,$id],
            [ProductInsideTexts::STATUS,1]
        ])->pluck(ProductInsideTexts::TEXT_TYPE)->toArray();
        return view('admin.product.edit', compact('product', 'categories', 'brands', 'subCategories', 'childCategories','productColours','colours','productFonts','fonts','productInsideText'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, string $id)
{
    $inside_text_type = implode(",", array_keys(Product::INSIDE_TEXT_TYPES));

    // Add validation for new fields (length, breadth, height, weight, hsn_code)
    $request->validate([
        'image' => ['nullable', 'image', 'max:3000'],
        'name' => ['required', 'max:200', Rule::unique('products')->ignore($id, 'id')],
        'category' => ['required'],
        'sub_category' => ['nullable'], // Added for flexibility, as you had it in the 'store' method
        'child_category' => ['nullable'], // Added for flexibility
        'brand' => ['required'],
        'price' => ['required', 'numeric', 'gte:0'], // Added numeric validation
        'qty' => ['required', 'numeric', 'gte:0'], // Added numeric validation
        'short_description' => ['required', 'max:600'],
        'long_description' => ['required'],
        'seo_title' => ['nullable', 'max:200'],
        'seo_description' => ['nullable', 'max:250'],
        'status' => ['required', 'in:0,1'], // Added in:0,1 validation
        'length' => ['nullable', 'numeric', 'gte:0'],
        'breadth' => ['nullable', 'numeric', 'gte:0'],
        'height' => ['nullable', 'numeric', 'gte:0'],
        'weight' => ['nullable', 'numeric', 'gte:0'],
        'hsn_code' => ['nullable', 'string', 'max:50'],
        'product_type' => ['nullable', 'in:new_arrival,featured_product,top_product,best_product,latest_product,best_seller_product'], // Added from store method
        'product_font' => ['nullable', 'array'],
        'product_font.*' => ['nullable', 'exists:fonts,id'],
        'product_colour' => ['nullable', 'array'],
        'product_colour.*' => ['nullable', 'exists:colours,id'],

        // Removed the validation rules for product_certificate, from_address, to_address
        // These fields are not in the database and should not be validated
    ]);

    $product = Product::findOrFail($id);

    /** Handle the image upload */
    $imagePath = $this->updateImage($request, 'image', 'uploads', $product->thumb_image);

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
    $product->product_type = $request->product_type; // Make sure this is in the form data
    $product->status = $request->status;
    $product->seo_title = $request->seo_title;
    $product->seo_description = $request->seo_description;
    $product->take_name = $request->take_name;

    // Remove the following lines that assign fields you want to delete.
    // This is crucial to prevent errors after the migration.
    // $product->product_certificate = ...
    // $product->from_address = ...
    // $product->to_address = ...

    // Handle new fields for Length, Breadth, Height, Weight, HSN Code
    $product->length = $request->length;
    $product->breadth = $request->breadth;
    $product->height = $request->height;
    $product->weight = $request->weight;
    $product->hsn_code = $request->hsn_code;

    // You should also clean up old fields related to inside text and options
    // I've removed the specific lines you had as they seem to relate to the old fields
    // and you have a separate function to handle it.
    // $product->{Product::TAKE_INSIDE_TEXT} = $request->{Product::TAKE_INSIDE_TEXT};
    // $product->{Product::INSIDE_TEXT_PRICE} = $request->{Product::INSIDE_TEXT_PRICE};
    // ... and so on

    $product->save();

    // Save fonts, colors, and inside texts
    $this->updateProductFontsAndColours($request, $id);
    $this->saveInsideTexts($request->inside_text_type, $id);

    toastr('Updated Successfully!', 'success');

    return redirect()->route('admin.products.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        dd("here");
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

    public function changeStatus(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated!']);
    }

    /**
     * Get all product sub categores
     */

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

    public function updateProductFontsAndColours(Request $request,$id){
        $user_id = Auth::user()->id;
        if(!empty($request->input("product_font"))){
            ProductFonts::where(ProductFonts::PRODUCT_ID,$id)->update(
                [
                    ProductFonts::STATUS=>0,
                    ProductFonts::UPDATED_BY=>$user_id,
                ]
            );
            $all = ProductFonts::where(ProductFonts::PRODUCT_ID,$id)->get();
            foreach($request->product_font as $font){
                $check = $all->where(ProductFonts::FONT_ID,$font)->first();
                if(empty($check)){
                    ProductFonts::insert([
                        ProductFonts::PRODUCT_ID=>$id,
                        ProductFonts::FONT_ID=>$font,
                        ProductFonts::STATUS=>1,
                        ProductFonts::CREATED_BY=>$user_id
                    ]);
                }else{
                    ProductFonts::where(ProductFonts::ID,$check->id)->update(
                        [
                            ProductFonts::STATUS=>1,
                            ProductFonts::UPDATED_BY=>$user_id,
                        ]
                    );
                }
            }
        }

        if(!empty($request->input("product_colour"))){
            ProductColours::where(ProductColours::PRODUCT_ID,$id)->update(
                [
                    ProductColours::STATUS=>0,
                    ProductColours::UPDATED_BY=>$user_id,
                ]
            );
            $all = ProductColours::where(ProductColours::PRODUCT_ID,$id)->get();
            foreach($request->product_colour as $colour){
                $check = $all->where(ProductColours::COLOUR_MASTER_ID,$colour)->first();
                if(empty($check)){
                    ProductColours::insert([
                        ProductColours::PRODUCT_ID=>$id,
                        ProductColours::COLOUR_MASTER_ID=>$colour,
                        ProductColours::STATUS=>1,
                        ProductColours::CREATED_BY=>$user_id
                    ]);
                }else{
                    ProductColours::where(ProductColours::ID,$check->id)->update(
                        [
                            ProductColours::STATUS=>1,
                            ProductColours::UPDATED_BY=>$user_id,
                        ]
                    );
                }
            }
        }
    }

    public function saveInsideTexts($texts,$productId){
        $user_id = Auth::user()->id;
        ProductInsideTexts::where(ProductInsideTexts::PRODUCT_ID,$productId)->update(
            [
                ProductColours::STATUS=>0,
                ProductColours::UPDATED_BY=>$user_id,
            ]
        );
        if(!empty($texts)){
            $product = ProductInsideTexts::where(ProductInsideTexts::PRODUCT_ID,$productId)->get();
            
            foreach($texts as $text){
                $check = $product->where(ProductInsideTexts::TEXT_TYPE,$text)->first();
                if(empty($check)){
                    ProductInsideTexts::insert([
                        ProductInsideTexts::PRODUCT_ID=>$productId,
                        ProductInsideTexts::TEXT_TYPE=>$text,
                        ProductInsideTexts::STATUS=>1,
                        ProductInsideTexts::CREATED_BY=>$user_id
                    ]);
                }else{
                    ProductInsideTexts::where(ProductInsideTexts::ID,$check->id)->update(
                        [
                            ProductInsideTexts::STATUS=>1,
                            ProductInsideTexts::UPDATED_BY=>$user_id,
                        ]
                    );
                }
            }
        }
    }

}
