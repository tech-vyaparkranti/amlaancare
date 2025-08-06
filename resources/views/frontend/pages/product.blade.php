@extends('frontend.layouts.master3')


@section('meta_description', $category->meta_description ?? "")
@section('meta_keywords', $category->meta_keyword ?? "")
@section('robots',$category->robots ?? "")
@section('canonical', $category->canonical ?? "")
@section('sitemap', $category->sitemap ?? "")
@section('og_title',$category->og_title ?? "")
@section('og_local',$category->og_local ?? "")
@section('og_url',$category->og_url ?? "")
@section('og_site_name',$category->og_site_name ?? "")
@section('og_type',$category->og_type ?? "")

@section('title')
    {{ $settings->site_name ?? '' }} || Shop Products
@endsection

@section('content')
    <!--============================ Category Banner START ==============================-->
    @if (!empty($category_banner))
    <div class="category-banner">
        <img class="img-fluid w-100" alt="{{ $settings->site_name ?? '' }}" src="{{ asset('storage/' . $category_banner) }}">
    </div>
@endif


    {{-- @if (!empty($categories[0]->category_banner) && $categories[0]->status == 1)
    <div class="category-banner">
        <a class="d-block" href="{{ $categories[0]->category_url ?? '#' }}">
            <img class="img-fluid w-100" alt="{{ $settings->site_name ?? '' }}"
                src="{{ asset('storage/' . $categories[0]->category_banner) }}" alt="">
        </a>
    </div>
    @else
    <p>no banner available</p>
    @endif --}}
    @php use Illuminate\Support\Facades\Request;
        $categories = DB::table('categories')->get();
        $currentCategorySlug = Request::query('category');
    @endphp
    @foreach ($categories as $category)
        @if (!empty($category->category_banner) && $category->status == 1)
            @if ($currentCategorySlug == $category->slug)
                <div class="category-banner">
                    <a class="d-block" href="{{ $category->category_url ?? '#' }}">
                        <img class="img-fluid w-100" alt="{{ $settings->site_name ?? '' }}"
                            src="{{ asset('storage/' . $category->category_banner) }}" alt="Category Banner">
                    </a>
                </div>
            @endif
            {{-- @else
          <p>No banner available for category: {{ $category->name }}</p> --}}
        @endif
    @endforeach
    {{-- @if (!empty($categories[0]->category_banner) && $categories[0]->status == 1)
    <div class="category-banner">
        <a class="d-block" href="{{ $categories[0]->category_url ?? '#' }}">
            <img class="img-fluid w-100" alt="{{ $settings->site_name ?? '' }}"
                src="{{ asset('storage/' . $categories[0]->category_banner) }}" alt="">
        </a>
    </div>
    @else
    <p>no banner available</p>
    @endif --}}
    <!--============================
                Category Banner END
            ==============================-->
    <!--============================
                BREADCRUMB START
            ==============================-->
    {{-- <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">Products</a></li>
                <li><a
                        href="{{ route('products.index', ['category' => $categories[0]->slug]) }}">{{ $categories[0]->name }}</a>
                </li>
            </ul>
        </div>
    </div> --}}
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <!-- Home Link -->
                <li><a href="{{ route('shop') }}">Home</a></li>

                <!-- Products Link -->
                <li><a href="{{ route('products.index') }}">Products</a></li>

                <!-- Category Breadcrumb -->
                @if (isset($category_slug))
                    @php
                        $category = DB::table('categories')->where('slug', $category_slug)->first();
                    @endphp
                    @if ($category)
                        <li>
                            <a href="{{ route('products.index', ['category_slug' => $category->slug]) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endif
                @endif

                <!-- Subcategory Breadcrumb -->
                @if (isset($subcategory_slug))
                    @php
                        $subcategory = DB::table('sub_categories')->where('slug', $subcategory_slug)->first();
                    @endphp
                    @if ($subcategory)
                        <li>
                            <a href="{{ route('products.index', ['category_slug' => $category_slug, 'subcategory_slug' => $subcategory->slug]) }}">
                                {{ $subcategory->name }}
                            </a>
                        </li>
                    @endif
                @endif

                <!-- Childcategory Breadcrumb -->
                @if (isset($childcategory_slug))
                    @php
                        $childcategory = DB::table('child_categories')->where('slug', $childcategory_slug)->first();
                    @endphp
                    @if ($childcategory)
                        <li>
                            <a href="{{ route('products.index', ['category_slug' => $category_slug, 'subcategory_slug' => $subcategory_slug, 'childcategory_slug' => $childcategory->slug]) }}">
                                {{ $childcategory->name }}
                            </a>
                        </li>
                    @endif
                @endif

                <!-- Brand Breadcrumb -->
                @if (isset($brand_slug))
                    @php
                        $brand = DB::table('brands')->where('slug', $brand_slug)->first();
                    @endphp
                    @if ($brand)
                        <li>
                            <a href="{{ route('products.index', ['category_slug' => $category_slug, 'subcategory_slug' => $subcategory_slug, 'childcategory_slug' => $childcategory_slug, 'brand_slug' => $brand->slug]) }}">
                                {{ $brand->name }}
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>



    <!--============================
                BREADCRUMB END
            ==============================-->


    <!--============================
                PRODUCT PAGE START
            ==============================-->
    <section id="product_page" class="mt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="sidebar_filter ">
                        <p>filter</p>
                        <span class="filter_icon">
                            <i class="far fa-minus" id="minus"></i>
                            <i class="far fa-plus" id="plus"></i>
                        </span>
                    </div>
                    <div class="product_sidebar" id="sticky_sidebar">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        All Categories
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($categories as $category)
                                                <li>
                                                    <a href="{{ route('products.index', ['category_slug' => $category->slug]) }}">
                                                        {{ $category->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSubCategory" aria-expanded="false" aria-controls="collapseSubCategory">
                                        All Sub Categories
                                    </button>
                                </h2>
                                <div id="collapseSubCategory" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                     data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach (DB::table('sub_categories')
                                                ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
                                                ->where('sub_categories.status', 1)
                                                ->where('categories.status', 1)
                                                ->get(['sub_categories.*', 'categories.slug as category_slug']) as $subCategory)
                                                <li>
                                                    <a href="{{ route('products.index', ['category_slug' => $subCategory->category_slug, 'subcategory_slug' => $subCategory->slug]) }}">
                                                        {{ $subCategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>


                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                        All Child Categories
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($childCategory as $childCategory)
                                                @php
                                                    // Fetch the associated subcategory and category for the current child category
                                                    $subcategory = DB::table('sub_categories')->where('id', $childCategory->sub_category_id)->first();
                                                    $category = DB::table('categories')->where('id', $subcategory->category_id)->first();
                                                @endphp

                                                <li>
                                                    <a href="{{ route('products.index', ['category_slug' => $category->slug, 'subcategory_slug' => $subcategory->slug, 'childcategory_slug' => $childCategory->slug]) }}">
                                                        {{ $childCategory->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Price
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="price_ranger">
                                            <form action="{{ url()->current() }}">
                                                @foreach (request()->query() as $key => $value)
                                                    @if ($key != 'range')
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}" />
                                                    @endif
                                                @endforeach
                                                <input type="hidden" id="slider_range" name="range"
                                                    class="flat-slider" />
                                                <button type="submit" class="common_btn">filter</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree3">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree3" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        brand
                                    </button>
                                </h2>
                                <div id="collapseThree3" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree3" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($brands as $brand)
                                            @php
                                            // Fetch the associated subcategory and category for the current child category
                                            $subcategory = DB::table('sub_categories')->where('id', $childCategory->sub_category_id)->first();
                                            $category = DB::table('categories')->where('id', $subcategory->category_id)->first();
                                        @endphp
                                                <li>
                                                    <!-- Create a clean URL for the brand slug -->
                                                    <a href="{{ route('products.index', ['category_slug' => $category_slug, 'subcategory_slug' => $subcategory_slug, 'childcategory_slug' => $childcategory_slug, 'brand_slug' => $brand->slug]) }}">
                                                        {{ $brand->name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                        Collections
                                    </button>
                                </h2>
                                <div id="collapsefive" class="accordion-collapse collapse"
                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($collections as $collection)
                                                <li><a
                                                        href="{{ route('frontend.collections.show', $collection->id) }}">{{ $collection->collection_name }}</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8">
                    <div class="row">
                        <div class="col-xl-12 d-none d-md-block mt-md-4 mt-lg-0">
                            <div class="product_topbar">
                                <div class="product_topbar_left">
                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist"
                                        aria-orientation="vertical">
                                        <button
                                            class="nav-link {{ session()->has('product_list_style') && session()->get('product_list_style') == 'grid' ? 'active' : '' }} {{ !session()->has('product_list_style') ? 'active' : '' }} list-view"
                                            data-id="grid" id="v-pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-home" type="button" role="tab"
                                            aria-controls="v-pills-home" aria-selected="true">
                                            <i class="fas fa-th"></i>
                                        </button>
                                    {{-- cart image part big size --}}
                                        <button
                                            class="nav-link list-view {{ session()->has('product_list_style') && session()->get('product_list_style') == 'list' ? 'active' : '' }}"
                                            data-id="list" id="v-pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#v-pills-profile" type="button" role="tab"
                                            aria-controls="v-pills-profile" aria-selected="false">
                                            <i class="fas fa-list-ul"></i>
                                        </button>



                                        {{-- cart image part big size --}}
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade {{ session()->has('product_list_style') && session()->get('product_list_style') == 'grid' ? 'show active' : '' }} {{ !session()->has('product_list_style') ? 'show active' : '' }}"
                                id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                {{-- <div class="row"> --}}
                                <div class="products_list">
                                    @foreach ($products as $product)
                                        {{-- <div class="col-xl-4 col-sm-6 col-6"> --}}
                                        <div class="products_list_item">
                                            <div class="product_item">
                                                @if (!empty(productType($product->product_type)))
                                                    <span class="new">{{ productType($product->product_type) }}</span>
                                                @endif
                                                {{-- <span class="new">{{$product->product_type}}</span> --}}
                                                @if (checkDiscount($product))
                                                    <span
                                                        class="minus">-{{ calculateDiscountPercent($product->price, $product->offer_price) }}%</span>
                                                @endif
                                                <a class="pro_link" href="{{ route('product-detail', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1" />
                                                    <img src="
                                                @if (isset($product->productImageGalleries[0]->image)) {{ asset($product->productImageGalleries[0]->image) }}
                                                @else
                                                    {{ asset($product->thumb_image) }} @endif
                                                "
                                                        alt="product" class="img-fluid w-100 img_2" />
                                                </a>
                                                <ul class="single_pro_icon">
                                                    <li><a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal" class="show_product_modal"
                                                            data-id="{{ $product->id }}"><i class="far fa-eye"></i></a>
                                                    </li>
                                                    <li><a href="#" class="add_to_wishlist"
                                                            data-id="{{ $product->id }}"><i
                                                                class="far fa-heart"></i></a></li>
                                                    {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
                                                </ul>
                                                <div class="product_details">
                                                    <a class="pro_name" href="{{ route('product-detail', $product->slug) }}">{{ limitText($product->name, 53) }}</a>
                                                    {{-- <p class="stock_area"><span class="in_stock">in stock</span> (167
                                                        item)</p> --}}
                                                        @if ($product->qty>0)
                                                             <p class="stock_area"><span class="in_stock">in stock</span></p>
                                                        @else
                                                        <p class="stock_area"><span class="out_stock">out of stock</span></p>
                                                        @endif
                                                    <p class="pro_rating">

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $product->ratings_avg_review)
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor

                                                        <span>({{ $product->reviews_count }} review)</span>
                                                    </p>
                                                    <a class="category" href="#">{{ $product->category->name }}
                                                    </a>
                                                    @if (checkDiscount($product))
                                                        <p class="price">
                                                            {{ $settings->currency_icon ?? '' }}{{ $product->offer_price }}
                                                            <del>{{ $settings->currency_icon ?? '' }}{{ $product->price }}</del>
                                                        </p>
                                                    @else
                                                        <p class="price">
                                                            {{ $settings->currency_icon ?? '' }}{{ $product->price }}</p>
                                                    @endif
                                                    <form class="shopping-cart-form">
                                                        @csrf
                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}">
                                                        @foreach ($product->variants as $variant)
                                                            @if ($variant->status != 0)
                                                                <select class="d-none" name="variants_items[]">
                                                                    @foreach ($variant->productVariantItems as $variantItem)
                                                                        @if ($variantItem->status != 0)
                                                                            <option value="{{ $variantItem->id }}"
                                                                                {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                                                {{ $variantItem->name }}
                                                                                (${{ $variantItem->price }})
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            @endif
                                                        @endforeach
                                                        <input class="" name="qty" type="hidden"
                                                            min="1" max="100" value="1" />
                                                        <button class="add_cart" type="submit">add to cart</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            {{-- big card style --}}

                            <div class="tab-pane fade {{ session()->has('product_list_style') && session()->get('product_list_style') == 'list' ? 'show active' : '' }}"
                                id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                <div class="products_list products_list-fill">

                                    @foreach ($products as $product)
                                        <?php
                                        ?>

                                        <div class="products_list_item">
                                            <div class="product_item-new-cart list_view">
                                                <span class="new">{{ productType($product->product_type) }}</span>
                                                @if (checkDiscount($product))
                                                    <span
                                                        class="minus">-{{ calculateDiscountPercent($product->price, $product->offer_price) }}%</span>
                                                @endif

                                                {{-- <a class="pro_link" href="{{ route('product-detail', $product->slug) }}">
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                                        class="img-fluid w-100 img_1" />

                                                    <img src="
                                                @if (isset($product->productImageGalleries[0]->image)) {{ asset($product->productImageGalleries[0]->image) }}
                                                @else
                                                    {{ asset($product->thumb_image) }} @endif
                                                "
                                                        alt="product" class="img-fluid w-100 img_2" />
                                                </a> --}}
                                                <a class="pro_link" href="{{ route('product-detail', $product->slug) }}">
                                                    <!-- First Image (Always Rendered) -->
                                                    <img src="{{ asset($product->thumb_image) }}" alt="product" class="img-fluid-123 w-100 img_1" />

                                                    <!-- Second Image (Conditionally Rendered) -->
                                                    @if (isset($product->productImageGalleries[0]->image))
                                                        <img src="{{ asset($product->productImageGalleries[0]->image) }}" alt="product" class="img-fluid-123 w-100 img_2" />
                                                    @endif
                                                </a>
                                                <div class="product_details">
                                                    <a class="pro_name"
                                                        href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal" class="show_product_modal"
                                                        data-id="{{ $product->id }}"><i class="far fa-eye"></i></a>
                                                    <p class="stock_area"><span class="in_stock">in stock</span> (167
                                                        item)</p>
                                                    <p class="pro_rating">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $product->reviews_avg_rating)
                                                                <i class="fas fa-star"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor

                                                        <span>({{ $product->reviews_count }} review)</span>
                                                    </p>
                                                    <a class="category" href="#">{{ @$product->category->name }}
                                                    </a>

                                                    @if (checkDiscount($product))
                                                        <p class="price">
                                                            {{ $settings->currency_icon ?? '' }}{{ $product->offer_price }}
                                                            <del>{{ $settings->currency_icon ?? '' }}{{ $product->price }}</del>
                                                        </p>
                                                    @else
                                                        <p class="price">
                                                            {{ $settings->currency_icon ?? '' }}{{ $product->price }}</p>
                                                    @endif
                                                    <p class="list_description">{{ $product->short_description }}</p>
                                                    <ul class="single_pro_icon">
                                                        <form class="shopping-cart-form">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                            @foreach ($product->variants as $variant)
                                                                @if ($variant->status != 0)
                                                                    <select class="d-none" name="variants_items[]">
                                                                        @foreach ($variant->productVariantItems as $variantItem)
                                                                            @if ($variantItem->status != 0)
                                                                                <option value="{{ $variantItem->id }}"
                                                                                    {{ $variantItem->is_default == 1 ? 'selected' : '' }}>
                                                                                    {{ $variantItem->name }}
                                                                                    (${{ $variantItem->price }})
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            @endforeach
                                                            <input class="" name="qty" type="hidden"
                                                                min="1" max="100" value="1" />
                                                            <button class="add_cart_two mr-2" type="submit">add to
                                                                cart</button>
                                                        </form>
                                                        <ul class="single_pro_icon">
                                                            <li><a href="#" class="add_to_wishlist"
                                                                    data-id="{{ $product->id }}"><i
                                                                        class="far fa-heart"></i></a></li>
                                                        </ul>
                                                    </ul>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (count($products) === 0)
                        <div class="text-center mt-5">
                            <div class="card">
                                <div class="card-body">
                                    <h2>Product not found!</h2>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-xl-12 text-center">
                    <div class="mt-5" style="display:flex; justify-content:center">
                        @if ($products->hasPages())
                            {{ $products->withQueryString()->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                PRODUCT PAGE END
            ==============================-->
@endsection

{{-- @push('scripts')
    <script>
        $(document).ready(function(){
            $('.list-view').on('click', function(){
                let style = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{route('change-product-list-view')}}",
                    data: {style: style},
                    success: function(data){

                    }
                })
            })
        })
        @php
            if(request()->has('range') && request()->range !=  ''){
                $price = explode(';', request()->range);
                $from = $price[0];
                $to = $price[1];
            }else {
                $from = 0;
                $to = 8000;
            }
        @endphp
        jQuery(function () {
        jQuery("#slider_range").flatslider({
            min: 0, max: 10000,
            step: 100,
            values: [{{$from}}, {{$to}}],
            range: true,
            einheit: '{{$settings->currency_icon ?? ''}}'
        });
    });
    </script>
@endpush --}}
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.list-view').on('click', function() {
                let style = $(this).data('id');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('change-product-list-view') }}",
                    data: {
                        style: style
                    },
                    success: function(data) {

                    }
                })
            })
        })
        @php
            if (request()->has('range') && request()->range != '') {
                $price = explode(';', request()->range);
                $from = $price[0];
                $to = $price[1];
            } else {
                $from = 0;
                $to = 80000;
            }
        @endphp
        jQuery(function() {
            jQuery("#slider_range").flatslider({
                min: 0,
                max: 10000,
                step: 100,
                values: [{{ $from }}, {{ $to }}],
                range: true,
                einheit: '{{ $settings->currency_icon ?? '' }}'
            });
        });
    </script>
    <script>
        function filterPrices() {
            let slider_range = $("#slider_range").val();
            let min = 0;
            let max = 0;
            if (slider_range) {
                slider_range = slider_range.split(";");
                if (slider_range.length == 2) {
                    min = slider_range[0];
                    max = slider_range[1];
                }
            }
            if (max > 0) {
                $(".products_list_item").each(function() {
                    if ($(this).data('price') < min || $(this).data('price') > max) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            } else {
                $(".products_list_item").show();
            }

        }
    </script>


<style>

.product_item-new-cart{
    width: 900px;
       height: 340px;
       border: 1px solid black;
 border-radius: 5px;

}

.img-fluid-123 {
    max-width: 100%;
    height: 320px;
}


    .product-row {
       display: flex;
       flex-wrap: wrap;
   }

   /* Default (large screens) - 5 per row */
   .product-col {
       flex: 0 0 20%; /* 5 per row */
       max-width: 20%;
   }

   /* Tablet (576px and up) - 2 per row */
   @media (max-width: 576px) {
       .product-col {
           flex: 0 0 50%; /* 2 per row on small screens */
           max-width: 50%;
       }
       .product_item {
       width: 160px;
       height: 435px;
       margin-top: 0px;
       position: relative;
       overflow: hidden;
       /* min-height: 100%; */
       border-radius: 0px;
       background: #fff;
       transition: alllinear 0.3s;
       -webkit-transition: alllinear 0.3s;
       -moz-transition: all linear 0.3s;
       -ms-transition: all linear 0.3s;
       -o-transition: all linear 0.3s;
       background: #fff;
       box-shadow: var(--box-shadow) rgb(var(--color-black) / 15%);
       border-radius: 8px;
       border: 1px solid rgb(var(--color-black) / 20%);
   }
   .product_item {
       position: relative;
   }
   .position-relative {
       position: relative !important;
   }
   }

   /* Very small devices (optional) - 1 per row if screen is very narrow */
   @media (max-width: 360px) {
       .product-col {
           flex: 0 0 100%; /* 1 per row on tiny screens */
           max-width: 100%;
       }

   }

    /* Tablet (between 577px and 991px) - 3 per row */
   @media (min-width: 577px) and (max-width: 991px) {
       .product-col {
           flex: 0 0 33.33%;
           max-width: 33.33%;
       }

       .product_item {
           width: 100%;
           height: auto;
           padding: 10px;
           border: 1px solid rgba(0, 0, 0, 0.2);
           box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
           background: #fff;
           border-radius: 8px;
           transition: all 0.3s ease;
       }

       .product_item:hover {
           box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
       }
   }




/* Media query for screens smaller than 1024px (e.g., iPads in landscape) */
@media (max-width: 1024px) {
    .product_item-new-cart {
        width: 100%; /* Make the width responsive */
        height: 320px; /* Adjust height for tablets */
    }

    .img-fluid-123 {
        height: 290px !important;
    }
}



   /* Media query for screens smaller than 992px (e.g., tablets) */
@media (max-width: 992px) {
    .product_item-new-cart {
        width: 100%; /* Make the width responsive */
        height: 490px !important;
        /* padding: 10px;  */
    }

    .img-fluid-123 {
        height: 290px !important;
    }
}

/* Media query for screens smaller than 768px (e.g., mobile devices) */
@media (max-width: 768px) {
    .product_item-new-cart {
        width: 100%;
        height: 580px !important;
    }

    .img-fluid-123 {
        height: 200px; /* Set a fixed height for smaller screens */
    }
}


       </style>
@endpush
