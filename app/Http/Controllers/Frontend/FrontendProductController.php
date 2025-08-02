<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Adverisement;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\ProductReview;
use App\Models\ProductInsideTexts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\ProductCollectionMasterModel;
use App\Models\DownloadProductCertificate;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;


class FrontendProductController extends Controller
{
    public function productsIndex(Request $request, $category_slug = null, $subcategory_slug = null, $childcategory_slug = null, $brand_slug = null)
{
    // Initialize the products query
    $products = Product::withAvg('reviews', 'rating')
        ->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries']);

    // Initialize category variable
    $category = null;
    $category_banner = null;

    // dd($products);
    // If category_slug is provided, fetch category and apply filters
    if ($category_slug) {
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $category_banner = $category->category_banner;

        // Fetch subcategory if provided

        $subcategory = $subcategory_slug ? SubCategory::where('slug', $subcategory_slug)->where('category_id', $category->id)->firstOrFail() : null;

        // Fetch childcategory if provided

        $childcategory = $childcategory_slug ? ChildCategory::where('slug', $childcategory_slug)
            ->where('category_id', $category->id)
            ->where('sub_category_id', $subcategory ? $subcategory->id : null)
            ->firstOrFail() : null;

        // Fetch brand if provided
        $brand = $brand_slug ? Brand::where('slug', $brand_slug)->firstOrFail() : null;

        // Apply filters based on category, subcategory, childcategory, and brand
        $products = $products->where('category_id', $category->id)->where('status', 1);  // Ensuring status is 1

        if ($subcategory) {
            $products = $products->where('sub_category_id', $subcategory->id)->where('status', 1);  // Ensuring status is 1
        }

        if ($childcategory) {
            $products = $products->where('child_category_id', $childcategory->id)->where('status', 1);  // Ensuring status is 1
        }

        if ($brand) {
            $products = $products->where('brand_id', $brand->id)->where('status', 1);  // Ensuring status is 1
        }
    } else {
        // If no category_slug is provided, show all products with status 1
        $products = $products->where('status', 1)->where('is_approved', 1);
    }

    // Apply additional filters like price range and search
    if ($request->has('range')) {
        $price = explode(';', $request->range);
        $from = $price[0];
        $to = $price[1];
        $products = $products->whereBetween('price', [$from, $to]);
    }

    if ($request->has('search')) {
        $products = $products->where(function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('long_description', 'like', '%' . $request->search . '%');
        });
    }

    // Get paginated products
    $products = $products->paginate(12);

    // Get additional data like categories, subcategories, brands, etc.
    $categories = Category::where('status', 1)->get();
    $subCategory = SubCategory::where('status', 1)->get();
    $childCategory = ChildCategory::where('status', 1)->get();
    $brands = Brand::where('status', 1)->get();
    $collections = ProductCollectionMasterModel::where('status', 1)->get();

    // Fetch banner ad
    $productpage_banner_section = Adverisement::where('key', 'productpage_banner_section')->first();
    $productpage_banner_section = json_decode($productpage_banner_section?->value);

    // Return the view with necessary data
    return view('frontend.pages.product', compact(
        'products', 'categories', 'brands', 'productpage_banner_section',
        'collections', 'childCategory', 'subCategory', 'category_slug',
        'subcategory_slug', 'childcategory_slug', 'brand_slug', 'category', 'category_banner'
    ));
}


    

    /** Show product detail page */
    public function showProduct(string $slug)
    {
        $product = Product::with(['vendor', 'category', 'productImageGalleries', 'variants', 'brand','productFonts','productColours','productInsideText',])
        ->where('slug', $slug)->where('status', 1)->first();
        $reviews = ProductReview::with(['user','productReviewGalleries'])->where('product_id', $product->id)->where('status', 1)->paginate(10);
        $product_texture_colours = $product->productColours->where("type","texture_color");
        $product_zip_colours = $product->productColours->where("type","zip_color");
        $productInsideTextTypes = $product->productInsideText->pluck(ProductInsideTexts::TEXT_TYPE)->toArray();
        $INSIDE_TEXT_TYPES = Product::INSIDE_TEXT_TYPES;
        $insideTextOptions = [];
        if(!empty($productInsideTextTypes)){

            foreach($productInsideTextTypes as $item){
                $insideTextOptions[$item] = $INSIDE_TEXT_TYPES[$item];
            }
        }
        $certificateUrl = asset($product->product_certificate);
        $productsQuery = Product::where('status', 1);
        $youMaylike = $productsQuery->inRandomOrder()->take(8)->get();
        //dd($product->productColours->where("type","texture_color"));

        // data for showing map
        $productMap = Product::findOrFail($product->id);
 
        // Get coordinates for both from_address and to_address
        // $fromCoordinates = $this->getCoordinatesFromAddress($productMap->from_address);
        // $toCoordinates = $this->getCoordinatesFromAddress($productMap->to_address); 

        return view('frontend.pages.product-detail', compact('product', 'reviews','product_texture_colours',
        'product_zip_colours','insideTextOptions','youMaylike','certificateUrl','productsQuery'));
    }

    public function storeDownload(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'vendor_id' => 'required|integer|exists:vendors,id',
            'certificate_url' => 'required|string|max:255',
        ]);
    
        // Store the data in the download_product_certificates table
        $downloadCertificate = DownloadProductCertificate::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'product_name' => $validated['product_name'],
            'vendor_id' => $validated['vendor_id'],
            'certificate_url' => $validated['certificate_url'],
        ]);
    
        // Return success response
        return response()->json([
            'message' => 'Data saved successfully!',
            'download_certificate' => $downloadCertificate
        ]);
    }
    
    public function chageListView(Request $request)
    {
       Session::put('product_list_style', $request->style);
    }


     // Function to Get Coordinates (Latitude and Longitude) from Address using Nominatim API
     private function getCoordinatesFromAddress($address)
     {
        
        $url = 'https://nominatim.openstreetmap.org/search?format=json&q=' . urlencode($address);
        
        // Send GET request to Nominatim API
        // $response = Http::get($url);
        $response = Http::withHeaders([
            'User-Agent' => 'organicjikaka/1.0 (organicjikaka@gmail.com)', // Your app name and email
        ])->get($url);
        \Log::info('Nominatim Response Status: ' . $response->status());
        \Log::info('Nominatim Response Body: ' . $response->body());
        // Debugging: Dump the response status and body to inspect the response
        // dd($response->status(), $response->body());
        // Check if the request failed
        if ($response->failed()) {
            return response()->json(['error' => 'Failed to retrieve geocode data'], 500);
        }
        // Decode the JSON response
        $data = $response->json(); 

        // If a result is found, return the latitude and longitude
        if (isset($data[0])) {
            return [
                'latitude' => $data[0]['lat'],
                'longitude' => $data[0]['lon']
            ];
        }
        

        // If no result found, return default coordinates (0, 0)
        return [
            'latitude' => 0,
            'longitude' => 0
        ];
    }

   
}
