<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\FlashSale;
use App\Models\SubCategory;
use App\Models\Adverisement;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\FlashSaleItem;
use App\Models\HomePageSetting;
use App\Models\HomePageDetail;
use App\Models\SupplyChain;
use App\Models\Certification;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use App\Models\ProductCollectionMasterModel;

class HomeController extends Controller
{
    public function index1()
{

    // Retrieve sliders from cache
    $sliders = Cache::rememberForever('sliders', function () {
        return Slider::where('status', 1)->orderBy('serial', 'asc')->get();
    });

    // Retrieve recent blog posts
    $recentBlogs = Blog::with(['category', 'user'])->where('status', 1)->orderBy('id', 'DESC')->take(8)->get();

    // Retrieve the latest enabled home page detail
    $latestHomeDetail = HomePageDetail::where('status', 'enabled')->latest()->first();

    // Decode about us images from the home page detail
    $aboutUsImages = $latestHomeDetail ? json_decode($latestHomeDetail->about_us_images, true) : [];

    // Fetch active and latest supply chain data
    $latestSupplyChain = SupplyChain::where('status', 'active')->latest()->first();
    $qaArray = $latestSupplyChain ? json_decode($latestSupplyChain->faq, true) : [];

    $certifications = Certification::where('status', 'active')
    ->orderBy('serial', 'asc')
    ->get();

    $latestFaq = Faq::where('status', 'enabled')->latest()->first();
    $faqArray = $latestFaq ? json_decode($latestFaq->faq, true) : [];


    // Return the view with the necessary data
    return view('frontend.home.home', compact('sliders', 'recentBlogs', 'latestHomeDetail', 'aboutUsImages', 'latestSupplyChain','qaArray','certifications','faqArray'));

}

    public function index(Request $request)
    {
        $request->session()->put('current_page', url()->current());
        
        $sliders = Cache::rememberForever('sliders', function(){
            return Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        });

        $flashSaleDate = FlashSale::first();

        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)
        ->where('status', 1)
        ->pluck('product_id')
        ->toArray();

        $flashSaleActive = !empty($flashSaleItems);
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        // $product_list = Product::where('status', 1)->get();
        // dd( $product_list);
          // Fetch products tagged as 'latest' do not use like
          $latestProducts = Product::where('product_type', 'latest_product')
          ->where('status', 1)
          ->where('is_approved',1)  // Check that the product is active
          ->take(8)
          ->get();
          // Fetch products tagged as 'best seller'
          $bestSellerProducts = Product::where('product_type', 'best_seller_product')->where('is_approved',1)->take(8)->get();
          $saleProducts = Product::where('product_type', 'sale')->orWhere('product_type', 'like', '%featured%')->where('is_approved',1)->take(8)->get();

          $collection_four = Product::where('product_type', 'top_product')->where('is_approved',1)->take(4)->get();
          $brand_id = $request->query('brand_id');

          // Fetch all brands to display as filter options
          $brands = Brand::all();

          // If a brand_id is selected, filter products by that brand
          $products = Product::when($brand_id, function ($query) use ($brand_id) {
              return $query->where('brand_id', $brand_id);
          })
          ->where('status', 1)
          ->where('is_approved',1)
          ->orderBy('created_at', 'desc')
          ->take(9) // Optional: Limit the number of products displayed
          ->get();

          $fashionistaBrandIds = Product::select('brand_id')
          ->where('is_approved',1)
          ->distinct()
          ->pluck('brand_id');

      // Fetch products belonging to these brands
      $fashionistaProducts = Product::where('product_type', 'best_seller_product')
      ->where('status', 1)
      ->where('is_approved',1)
      ->orderBy('created_at', 'desc')
      ->take(8)
      ->get();

        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
           // Get brand IDs from the request if provided (?brands[]=1&brands[]=2)
        $brandIds = $request->input('brands', []);

        // Query to fetch active products from multiple brands or all active products
        $productsQuery = Product::where('status', 1);

        if (!empty($brandIds)) {
            // Apply brand filtering if brand IDs are provided
            $productsQuery->whereIn('brand_id', $brandIds);
        }

        // Fetch products (limit to 12 products)
        $festivalProducts = $productsQuery->inRandomOrder()->take(8)->get();

        $youMaylike = $productsQuery->inRandomOrder()->take(8)->get();

        // Check if products were fetched correctly (for debugging)
        // if ($festivalProducts->isEmpty()) {
        //     dd('No products found. Please check your data or filters.');
        // }

        $typeBaseProducts = $this->getTypeBaseProduct();
        $categoryProductSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductSliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        $categoryProductSliderSectionThree = HomePageSetting::where('key', 'product_slider_section_three')->first();

        // banners

        $homepage_secion_banner_one = Adverisement::where('key', 'homepage_secion_banner_one')->first();
        $homepage_secion_banner_one = json_decode($homepage_secion_banner_one->value??"");

        $homepage_secion_banner_two = Adverisement::where('key', 'homepage_secion_banner_two')->first();
        $homepage_secion_banner_two = json_decode($homepage_secion_banner_two->value??"");

        $homepage_secion_banner_three = Adverisement::where('key', 'homepage_secion_banner_three')->first();
        $homepage_secion_banner_three = json_decode($homepage_secion_banner_three->value??"");

        $homepage_secion_banner_four = Adverisement::where('key', 'homepage_secion_banner_four')->first();
        $homepage_secion_banner_four = json_decode($homepage_secion_banner_four->value??"");

        $recentBlogs = Blog::with(['category', 'user'])->where('status',1)->orderBy('id', 'DESC')->take(8)->get();
        $collections = ProductCollectionMasterModel::with('collectionProducts')->where('status',1)->get();
        // dd($brands[0]->logo);
        return view('frontend.pages.shop',
            compact(
                'sliders',
                'flashSaleDate',
                'flashSaleItems',
                'flashSaleActive',
                'popularCategory',
                'brands',
                'typeBaseProducts',
                'categoryProductSliderSectionOne',
                'categoryProductSliderSectionTwo',
                'categoryProductSliderSectionThree',

                'homepage_secion_banner_one',
                'homepage_secion_banner_two',
                'homepage_secion_banner_three',
                'homepage_secion_banner_four',
                'recentBlogs',
                'bestSellerProducts',
                'latestProducts',
                'saleProducts',
                'products',
                'brand_id',
                'brands',
                'fashionistaProducts',
                'festivalProducts',
                'collections',
                'youMaylike',
                'collection_four',
                // 'thumb_image',
            ));
    }

    public function getTypeBaseProduct()
    {
        $typeBaseProducts = [];

        $typeBaseProducts['new_arrival'] = Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'new_arrival', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        $typeBaseProducts['featured_product'] = Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'featured_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        $typeBaseProducts['top_product'] = Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'top_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        $typeBaseProducts['latest_product'] = Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'latest_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        $typeBaseProducts['best_seller_product'] = Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'best_seller_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        $typeBaseProducts['best_product'] = Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where(['product_type' => 'best_product', 'is_approved' => 1, 'status' => 1])->orderBy('id', 'DESC')->take(8)->get();

        return $typeBaseProducts;
    }

    public function vendorPage()
    {
       $vendors = Vendor::where('status',1)->paginate(20);
       return view('frontend.pages.vendor', compact('vendors'));
    }

    public function vendorProductsPage(string $id)
    {

        $products = Product::where(['status' => 1, 'is_approved' => 1, 'vendor_id' => $id])->orderBy('id', 'DESC')->paginate(12);

        $categories = Category::where(['status' => 1])->get();
        $brands = Brand::where(['status' => 1])->get();
        $vendor = Vendor::findOrFail($id);

        return view('frontend.pages.vendor-product', compact('products', 'categories', 'brands', 'vendor'));

    }

    function ShowProductModal(string $id) {
       $product = Product::findOrFail($id);

       $content = view('frontend.layouts.modal', compact('product'))->render();

       return Response::make($content, 200, ['Content-Type' => 'text/html']);
    }
}
