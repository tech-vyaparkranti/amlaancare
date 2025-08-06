@extends('frontend.layouts.master')
@section('title')
{{$settings->site_name ?? ''}} || Shop
@endsection
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"> --}}

@section('content')




    <!--============================
    BANNER PART 2 START
    ==============================-->
    {{-- @include('frontend.home.sections.banner-slider') --}}
    <!--============================
        BANNER PART 2 END
    ==============================-->

    {{-- <section class="sale-section" title="Dynamic Section for change Orders same as (new multi add & delete) option and also change orders">
        <div class="site-title text-center mb-3" title="Dynamic Title Not Req for upload">
            <h3>Shop By Collection</h3>
        </div>
        <div class="container">
            <div class="homeProductCard customMobileSlide collection_slider pb-4">
                @foreach ($collections as $collection)
                <div class="products_list_item">
                    <div class="product_item">
                        <a class="pro_link"
                            href="{{ route('frontend.collections.show', ['id'=>$collection->id,"collection_name"=>str_replace(" ","-",strtolower($collection->collection_name))]) }}">
                            <img src="{{ asset($collection->collection_image) }}" alt="{{ $collection->collection_name }}"
                                class="img-fluid w-100 img_1">
                            <img src="{{ asset($collection->collection_image) }}" alt="{{ $collection->collection_name }}" class="img-fluid w-100 img_2">
                        </a>
                        <div class="product_details">
                            <a class="pro_name" href="{{ route('frontend.collections.show',['id'=>$collection->id,"collection_name"=>str_replace(" ","-",strtolower($collection->collection_name))]) }}">{{ $collection->collection_name }}</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section> --}}
    {{-- <br><br> --}}
    {{-- <ul class="container">
        <li><i>Tag Image change Only admin access ( Vendor Access Only add tags )</i></li>
        <li><i>After Show Only 4 Products show for product promotions tag by admin</i></li>
    </ul>
    <br><br> --}}

    {{-- NEW UPDATE --}}

    <section class="sale-section" title="Shop By Collection">
        <div class="site-title text-center mb-3" title="Shop By Collection">
            <h3>Shop By Collection</h3>
        </div>
        <div class="container">
            <div class="homeProductCard customMobileSlide collection_slider pb-4">
                @foreach ($collections as $collection)
                {{-- <div class="products_list_item">
                    <div class="product_item" style="transition: transform 0.3s ease-in-out;">
                        <a class="pro_link"
                            href="{{ route('frontend.collections.show', ['id'=>$collection->id,"collection_name"=>str_replace(" ","-",strtolower($collection->collection_name))]) }}">
                            <img src="{{ asset($collection->collection_image) }}" alt="{{ $collection->collection_name }}"
                                class="img-fluid w-100 img_1">
                            <img src="{{ asset($collection->collection_image) }}" alt="{{ $collection->collection_name }}" class="img-fluid w-100 img_2">
                        </a>
                        <div class="product_details">
                            <a class="pro_name" href="{{ route('frontend.collections.show',['id'=>$collection->id,"collection_name"=>str_replace(" ","-",strtolower($collection->collection_name))]) }}">{{ $collection->collection_name }}</a>
                        </div>
                    </div>
                </div> --}}
            {{-- new update card 3/4 --}}
            <div class="store-container123">
                {{-- <a class="pro_link"
                            href="{{ route('frontend.collections.show', ['id'=>$collection->id,"collection_name"=>str_replace(" ","-",strtolower($collection->collection_name))]) }}"> --}}
                            <div class="store-card"
                            onclick="window.location.href='{{ route('frontend.collections.show', ['id'=>$collection->id, 'collection_name'=>str_replace(' ', '-', strtolower($collection->collection_name))]) }}'" style="cursor: pointer;">
                           <div class="store-header">
                        <img src="{{ asset($collection->collection_image) }}" alt="{{ $collection->collection_name }}" class="store-logo">
                    </div>
                    <div class="store-body">

                        <h3 class="store-name">{{ $collection->collection_name }}</h3>

                        {{-- <p class="delivery-time">Delivery by 6:15am</p> --}}
                        <button class="discount-btn">{{ $collection->text ? $collection->text : '5% off on this collection' }}</button>
                        <div class="product-images">
                            @if ($collection->collectionProducts->isEmpty())
                            <img src="{{ asset('https://img.freepik.com/premium-vector/lorem-ipsum-logo-design-colorful-gradient_779267-46.jpg?w=2000') }}" alt="Product 1">
                            <img src="{{ asset('https://img.freepik.com/premium-vector/lorem-ipsum-logo-design-colorful-gradient_779267-46.jpg?w=2000') }}" alt="Product 2">
                            <img src="{{ asset('https://img.freepik.com/premium-vector/lorem-ipsum-logo-design-colorful-gradient_779267-46.jpg?w=2000') }}" alt="Product 3">

                            @else
                            @foreach ($collection->collectionProducts->take(3) as $item)
                                <img src="{{ asset($item->thumb_image) }}" alt="Product 1">
                            @endforeach

                            @endif

                        </div>
                    </div>
                </div>
            </div>


            {{-- new update card 3/4 --}}
                @endforeach
            </div>
        </div>
    </section>


    {{-- new sub-category part --}}

    <style>

        .products-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            overflow-x: auto;
            padding: 20px 0;
        }

        .product-card {
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 250px;
            min-width: 250px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            position: relative;
        }

        .product-card:nth-child(1) {
            background-color: #fef6f2;
        }

        .product-card:nth-child(2) {
            background-color: #f2f8ef;
        }

        .product-card:nth-child(3) {
            background-color: #fbf8f5;
        }

        .product-card:nth-child(4) {
            background-color: #f5faef;
        }

        .product-title {
            font-size: 18px;
            font-weight: bold;
            color: #1a1a1a;
            margin-bottom: 20px;
        }

        .product-image {
                width: 100%;
                height: 120px;
                object-fit: contain;
                object-position: center;
                margin-bottom: 15px;
                background-color: #f9f9f9;
                display: block;
                max-width: 100%;
            }


        .shop-button {
            display: inline-flex;
            align-items: center;
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 25px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            width: 126px;
        }

        .shop-button:hover {
            background-color: #45a049;
        }

        .shop-button::after {
            content: "→";
            margin-left: 8px;
            font-size: 16px;
        }

    @media (max-width: 1024px) {
    .products-container {
        justify-content: flex-start;
        padding: 15px 15px;
        gap: 15px;
        overflow-x: auto;
        flex-wrap: nowrap;
    }

    .product-card {
        width: 220px;
        min-width: 220px;
        padding: 15px;
    }

    .product-title {
        font-size: 16px;
    }

    .shop-button {
        font-size: 13px;
        padding: 8px 12px;
    }

    .shop-button::after {
        font-size: 14px;
    }
    .product-images {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 8px;
    margin-top: 10px;
}
}
      /* Medium Devices (Tablets) */
      @media (max-width: 768px) {
    .products-container {
        flex-wrap: nowrap;
        overflow-x: auto;

        padding: 15px 10px;
        justify-content: flex-start;
    }

    .product-card {
        width: 220px;
        min-width: 220px;
    }
}

/* Small Devices (Mobile Phones) */
@media (max-width: 480px) {
    .products-container {
        padding: 10px 10px;
        justify-content: flex-start;
    }

    .product-card {
        width: 180px;
        min-width: 180px;
        padding: 15px;
    }

    .product-title {
        font-size: 16px;
    }

    .shop-button {
        font-size: 12px;
        padding: 8px 12px;
    }

    .shop-button::after {
        font-size: 14px;
    }


}

    </style>

    {{-- <div class="products-container">
        <div class="product-card">
            <div class="product-title">Product 1</div>
            <img src="https://images6.alphacoders.com/411/thumb-1920-411545.jpg" alt="Fresh Meat" class="product-image">
            <a href="#" class="shop-button">Shop Now</a>
        </div>
        <div class="product-card">
            <div class="product-title">Product 2</div>
            <img src="https://tse4.mm.bing.net/th?id=OIP.7Pkja-oh5PU3wOoQnpblUwHaE5&pid=Api&P=0&h=220" alt="Fresh Vegetables" class="product-image">
            <a href="#" class="shop-button">Shop Now</a>
        </div>
        <div class="product-card">
            <div class="product-title">Product 3</div>
            <img src="https://tse1.mm.bing.net/th?id=OIP.Yeq0F2PpzV5O0L6pHOdQ1wHaEg&pid=Api" alt="Fresh Milk" class="product-image">
            <a href="#" class="shop-button">Shop Now</a>
        </div>
        <div class="product-card">
            <div class="product-title">Product 4</div>
            <img src="https://tse4.mm.bing.net/th?id=OIP.7Pkja-oh5PU3wOoQnpblUwHaE5&pid=Api&P=0&h=220" alt="Fresh Fruits" class="product-image">
            <a href="#" class="shop-button">Shop Now</a>
        </div>
    </div> --}}


    {{-- new sub-category part --}}


    {{-- NEW UPDATE --}}

    <section class="arrivals mt-4 mb-4">
        <div class="container">
            <div class="site-title text-center mb-3">
                <h3>Our Latest Product</h3>
            </div>

            <!-- Tab Navigation -->
            {{-- <ul class="nav mb-4" id="products-tab" role="tablist" style="display: flex; gap: 10px;">
                <li class="nav-item" role="presentation" style="list-style: none;">
                    <button class="nav-link active" id="latest-tab" data-bs-toggle="pill" data-bs-target="#latest" type="button" role="tab" aria-controls="latest" aria-selected="true"
                        style="background-color: #cce2c7; color: black; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;"
                        onclick="changeTabColor(this)">
                        Latest
                    </button>
                </li>
                <li class="nav-item" role="presentation" style="list-style: none;">
                    <button class="nav-link" id="best-seller-tab" data-bs-toggle="pill" data-bs-target="#best-seller" type="button" role="tab" aria-controls="best-seller" aria-selected="false"
                        style="background-color: #cce2c7;  color: black; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px;"
                        onclick="changeTabColor(this)">
                        Best Seller
                    </button>
                </li>
            </ul> --}}

            <script>
                function changeTabColor(selectedButton) {

                    document.querySelectorAll(".nav-link").forEach(button => {
                        button.style.backgroundColor = "#cce2c7";
                    });


                    selectedButton.style.backgroundColor = "#6c757d";
                }
            </script>



            <!-- Tab Content -->
            <div class="tab-content" id="pills-tabContent">
                <!-- Latest Products Tab -->
                <div class="tab-pane fade show active" id="latest" role="tabpanel" aria-labelledby="latest-tab">
                    <div class="homeProductCard">
                        @foreach ($latestProducts as $product)
                            @if ($product->status == 1)  <!-- Check if the product status is 1 -->
                                <x-product-card :product="$product" />
                            @endif
                        @endforeach
                    </div>
                </div>


                <!-- Best Seller Products Tab -->
                {{-- <div class="tab-pane fade" id="best-seller" role="tabpanel" aria-labelledby="best-seller-tab">
                    <div class="homeProductCard">
                        @foreach ($bestSellerProducts as $product)
                        @if ($product->status == 1)  <!-- Check if the product status is 1 -->
                        @include('partials.product_card', ['product' => $product])
                    @endif
                        @endforeach
                    </div>
                </div> --}}
            </div>
        </div>
    </section>




   <!-- <p class="text-center"> ================ Dynamic Section ================ </p> -->
   <section class="sale-section" title="Dynamic Section for change Orders same as (new multi add & delete) option and also change orders">
        @php
            $title = DB::table('titles')->where('id', 1)->first();
        @endphp
        @if ($title && $title->status === 'active')
            <div class="site-title text-center mb-3" title="{{ $title->name }}">
                <h3>{{ $title->name }}</h3>
            </div>

            <div class="saleBannerInner mb-4" title="{{ $title->name ?? 'Dynamic Banner Not Req for upload' }}">
                <img src="{{ $title->banner ?? 'https://dummyimage.com/1420x620/cfcfcf/363636.png' }}" class="img-fluid" alt="{{ $title->alt_text ?? '' }}" style="width: 100%; display: inline-block;">
            </div>
        @endif
        <div class="container">
            <div class="homeProductCard customMobileSlide">

            </div>
        </div>
   </section>


<section class="sale-section">
    <!-- Sale Banner -->
    <div class="saleBannerInner mb-4">
        <img src="{{ asset('uploads/Beige-Modern-Promotional-Fashion-SalesDiscounts-Banner.jpg') }}"
             class="img-fluid" alt="" style="width: 100%; display: inline-block;">
    </div>

    <!-- Sale Products Section -->
    <div class="container">
        <div class="homeProductCard customMobileSlide">
            @forelse ($saleProducts as $product)
                <div class="products_list_item">
                    <div class="product_item" style="transition: transform 0.3s ease-in-out;">
                        <!-- Tag Indicator -->
                        @if (strpos($product->tags, 'new') !== false)
                            <span class="new " style="">New</span>
                        @endif

                        <!-- Product Link & Images -->
                        <a class="pro_link" href="{{ route('product-detail', $product->slug) }}">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100 img_1">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100 img_2">
                        </a>

                        <!-- Icons for Modal and Wishlist -->
                        <ul class="single_pro_icon">
                            <li>
                                <a href="{{route('product-detail', $product->slug)}}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="show_product_modal" data-id="{{ $product->id }}">
                                    <i class="far fa-eye" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('product-detail', $product->slug)}}" class="add_to_wishlist" data-id="{{ $product->id }}">
                                    <i class="far fa-heart" aria-hidden="true"></i>
                                </a>
                            </li>
                        </ul>

                        <!-- Product Details -->
                        <div class="product_details" style="justify-content: flex-start">
                            <a class="pro_name" href="{{ route('product-detail', $product->slug) }}"style="justify-content: flex-start">{{ $product->name }}</a>

                             <!-- Review Section -->
                          <div class="product_review mt-1 d-flex align-items-center" style="justify-content: flex-start; font-size: 12px;">
                            <span class="rating" style="color: #f39c12; font-size: 12px; line-height: 1;">
                               4.8 ⭐
                            </span>
                            <span class="review_count" style="margin-left: 5px; color: #555; font-size: 12px; line-height: 1;">
                                ({{ $product->reviews_count ?? '0' }} reviews)
                            </span>
                        </div>

                    <!-- Review Section -->
                            <p class="price mt-1" style="justify-content: flex-start">
                                @if($product->offer_price)
                                    {{$settings->currency_icon ?? ''}}{{ number_format($product->offer_price, 2) }}
                                    <del>{{$settings->currency_icon ?? ''}}{{ number_format($product->price, 2) }}</del>
                                @else
                                    {{$settings->currency_icon ?? ''}}{{ number_format($product->price, 2) }}
                                @endif
                            </p>


                           {{-- <form class="shopping-cart-form d-none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1" min="1" max="100">
                                    <button class="add_cart btn btn-primary mt-2" type="submit">Add to Cart</button>
                                </form> --}}
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <form class="shopping-cart-form" method="POST" action="">
                                <form class="shopping-cart-form" method="POST" action="">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="quantity-selector" style="display: none; align-items: center; gap: 8px; margin-bottom: 8px;">
        <button type="button" class="qty-btn minus" aria-label="Decrease quantity">−</button>
        <input class="number_area" name="qty" type="number" min="1" max="100" value="1" readonly style="width: 45px; text-align: center;">
        <button type="button" class="qty-btn plus" aria-label="Increase quantity">+</button>
        <button type="submit" class="add_cart_button" style="margin-left:10px;">
            Add To Cart <i class="fa fa-shopping-cart"></i>
        </button>
    </div>
    <button type="button" class="show-qty-btn add_cart_button">
        Add To Cart <i class="fa fa-shopping-cart"></i>
    </button>
</form>                                                                                                                                                                                                      @csrf
          
                        </div>
                    </div>
                </div>
            @empty
                {{-- <p>No sale products available at the moment.</p> --}}
            @endforelse
        </div>
    </div>
</section>

{{-- Timer section  --}}
{{-- <section class="sale-section mt-5">
    <div class="saleBannerInner mb-4">
        <img src="frontend/images/timer-banner.jpg" class="img-fluid" alt="organicjikaka" style="width: 100%; display: inline-block;">
        <div class="sale-timer">
            <div class="moving_slide" id="moving_slide">
                <span id="sale-timer" style="display: none;">HAPPY HOURS ENDS IN:</span>
                <div id="clockdiv">
                    <div class="timer_slide">
                        <span class="days"></span>
                        <div class="smalltext">Days</div>
                    </div>
                    <div class="timer_slide">
                        <span class="hours"></span>
                        <div class="smalltext">Hours</div>
                    </div>
                    <div class="timer_slide">
                        <span class="minutes"></span>
                        <div class="smalltext">Minutes</div>
                    </div>
                    <div class="timer_slide">
                        <span class="seconds"></span>
                        <div class="smalltext">Seconds</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}
{{-- Timer section End  --}}







<section class="sale-section">
    <!-- Sale Banner -->
    {{-- <div class="saleBannerInner mb-4">
        <img src="{{ asset('uploads/Beige-Modern-Promotional-Fashion-SalesDiscounts-Banner.jpg') }}"
             class="img-fluid" alt="organicjikaka" style="width: 100%; display: inline-block;">
    </div> --}}

    <!-- Sale Products Section -->
    <div class="container">
        <div class="homeProductCard customMobileSlide">
            @forelse ($collection_four as $product)
                <div class="products_list_item">
                    <div class="product_item" >
                        <!-- Tag Indicator -->
                        @if (strpos($product->tags, 'new') !== false)
                            <span class="new">New</span>
                        @endif

                        <!-- Product Link & Images -->
                        <a class="pro_link" href="{{ route('product-detail', $product->slug) }}">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100 img_1">
                            <img src="{{ asset($product->thumb_image) }}" alt="{{ $product->name }}" class="img-fluid w-100 img_2">
                        </a>

                        <!-- Icons for Modal and Wishlist -->
                        <ul class="single_pro_icon">
                            <li>
                                <a href="{{route('product-detail', $product->slug)}}" data-bs-toggle="modal" data-bs-target="#exampleModal" class="show_product_modal" data-id="{{ $product->id }}">
                                    <i class="far fa-eye" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('product-detail', $product->slug)}}" class="add_to_wishlist" data-id="{{ $product->id }}">
                                    <i class="far fa-heart" aria-hidden="true"></i>
                                </a>
                            </li>
                            <li><a href="#" class="add_to_wishlist" data-id="{{ $product->id }}" aria-label="Add to Wishlist"><i class="far fa-heart" aria-hidden="true"></i></a></li>
                        </ul>

                        <!-- Product Details -->
                        <div class="product_details">
                            <a class="pro_name" href="{{ route('product-detail', $product->slug) }}">{{ $product->name }}</a>
                            <p class="price">₹{{ $product->price }}</p>

                          <!-- Add to Cart Form -->
                            {{-- <form class="shopping-cart-form" method="POST" action="" hidden>
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="qty" value="1">
                                <button class="add_cart" type="submit">Add to Cart</button>
                            </form> --}}
                           <form class="shopping-cart-form" method="POST" action="">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="quantity-selector" style="display: none; align-items: center; gap: 8px; margin-bottom: 8px;">
        <button type="button" class="qty-btn minus" aria-label="Decrease quantity">−</button>
        <input class="number_area" name="qty" type="number" min="1" max="100" value="1" readonly style="width: 45px; text-align: center;">
        <button type="button" class="qty-btn plus" aria-label="Increase quantity">+</button>
        <button type="submit" class="add_cart_button" style="margin-left:10px;">
            Add To Cart <i class="fa fa-shopping-cart"></i>
        </button>
    </div>
    <button type="button" class="show-qty-btn add_cart_button">
        Add To Cart <i class="fa fa-shopping-cart"></i>
    </button>
</form>

                        </div>
                    </div>
                </div>
            @empty
                {{-- <p>No sale products available at the moment.</p> --}}
            @endforelse
        </div>
    </div>
</section>


 <!--============================
        FLASH SELL START
    ==============================-->
    @if($flashSaleActive)
@include('frontend.home.sections.flash-sale')
@endif
    <!--============================
        FLASH SELL END
    ==============================-->
<section class="arrivels mt-4 mb-4">
    <div class="container">
        <div class="site-title text-center mb-3">
            <h3>Our Top Selling Products</h3>
        </div>
        <div class="homeProductCard customMobileSlide fashionistas_row row">
            <div class="homeProductCard">
                @foreach ($bestSellerProducts as $product)
                @if ($product->status == 1)  <!-- Check if the product status is 1 -->
                <x-product-card :product="$product" />
                @endif
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- <section class="arrivels mt-4 mb-4">
    <div class="container">
        <div class="site-title text-center mb-3">
            <h3>Festival Wears</h3>
        </div>
        <div class="homeProductCard customMobileSlide">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                @forelse($festivalProducts as $product)
                <div class="col">
                    <div class="products_list_item">
                        <div class="product_item position-relative">
                            <span class="new badge bg-primary position-absolute" style="top: 10px; left: 10px;">New</span>

                            <a class="pro_link" href="{{route('product-detail', $product->slug)}}">
                                <img src="{{ asset($product->thumb_image) }}"
                                     alt="{{ $product->name }}" class="img-fluid w-100 img_1">
                                <img src="{{ asset($product->thumb_image) }}"
                                     alt="{{ $product->name }}" class="img-fluid w-100 img_2">
                            </a>

                            <ul class="single_pro_icon">
                                <li>
                                    <a href="{{route('product-detail', $product->slug)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                       class="show_product_modal" data-id="{{ $product->id }}">
                                        <i class="far fa-eye" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('product-detail', $product->slug)}}" class="add_to_wishlist" data-id="{{ $product->id }}">
                                        <i class="far fa-heart" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>

                            <div class="product_details text-flex-start mt-3" style="justify-content: flex-start">
                                <a href="{{route('product-detail', $product->slug)}}" class="pro_name" title="{{ $product->name }}" style="justify-content: flex-start">
                                    {{ $product->name }}
                                </a>

                                 <!-- Review Section -->
                                 <div class="product_review mt-1 d-flex align-items-center" style="justify-content: flex-start; font-size: 12px;">
                                    <span class="rating" style="color: #f39c12; font-size: 12px; line-height: 1;">
                                       4.8 ⭐
                                    </span>
                                    <span class="review_count" style="margin-left: 5px; color: #555; font-size: 12px; line-height: 1;">
                                        ({{ $product->reviews_count ?? '0' }} reviews)
                                    </span>
                                </div>

                            <!-- Review Section -->
                                <p class="price mt-1" style="justify-content: flex-start">
                                    @if($product->offer_price)
                                        {{$settings->currency_icon ?? ''}}{{ number_format($product->offer_price, 2) }}
                                        <del>{{$settings->currency_icon ?? ''}}{{ number_format($product->price, 2) }}</del>
                                    @else
                                        {{$settings->currency_icon ?? ''}}{{ number_format($product->price, 2) }}
                                    @endif
                                </p>

                                <form class="shopping-cart-form d-none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1" min="1" max="100">
                                    <button class="add_cart btn btn-primary mt-2" type="submit">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center">No products available for Festival Wears.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section> --}}

@if(isset($homepage_secion_banner_one->banner_one) && isset($homepage_secion_banner_one->banner_one->banner_image) && isset($homepage_secion_banner_one->banner_one->banner_url))

{{-- <a href="{{ $homepage_secion_banner_one->banner_one->banner_url }}" target="_blank" style="display: block;"> --}}
<section class="arrivels mt-4 mb-4"style="background-image: url('{{ asset($homepage_secion_banner_one->banner_one->banner_image) }}');
    background-size: cover;
    background-position: center;" >
    <div class="container" style="padding: 10px; padding-bottom: 20px;">
        <div class="site-title text-center mb-3">
            <a href="{{ $homepage_secion_banner_one->banner_one->banner_url }}" target="_blank" style="display: block; ">
            <h3>You May Also Like</h3>
            </a>
        </div>
        <div class="homeProductCard customMobileSlide collection_slider">
            {{-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4"> --}}
                @forelse($youMaylike as $product)
                <div class="col">
                    <div class="products_list_item">
                        <div class="product_item position-relative">
                            <span class="new badge bg-primary position-absolute" style="top: 10px; left: 10px;">New</span>

                            <a class="pro_link" href="{{route('product-detail', $product->slug)}}">
                                <img src="{{ asset($product->thumb_image) }}"
                                     alt="{{ $product->name }}" class="img-fluid w-100 img_1">
                                <img src="{{ asset($product->thumb_image) }}"
                                     alt="{{ $product->name }}" class="img-fluid w-100  img_2">
                            </a>

                            <ul class="single_pro_icon">
                                <li>
                                    <a href="{{route('product-detail', $product->slug)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                       class="show_product_modal" data-id="{{ $product->id }}">
                                        <i class="far fa-eye" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('product-detail', $product->slug)}}" class="add_to_wishlist" data-id="{{ $product->id }}">
                                        <i class="far fa-heart" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>

                            <div class="product_details text-flex-start mt-3" style="justify-content: flex-start">
                                <a href="{{route('product-detail', $product->slug)}}" class="pro_name" title="{{ $product->name }}" style="justify-content: flex-start">
                                    {{ $product->name }}
                                </a>

                                <!-- Review Section -->
                                <div class="product_review mt-1 d-flex align-items-center" style="justify-content: flex-start; font-size: 12px;">
                                    <span class="rating" style="color: #f39c12; font-size: 12px; line-height: 1;">
                                       4.8 ⭐
                                    </span>
                                    <span class="review_count" style="margin-left: 5px; color: #555; font-size: 12px; line-height: 1;">
                                        ({{ $product->reviews_count ?? '0' }} reviews)
                                    </span>
                                </div>

                            <!-- Review Section -->
                                <p class="price mt-1" style="justify-content: flex-start">
                                    @if($product->offer_price)
                                        {{$settings->currency_icon ?? ''}}{{ number_format($product->offer_price, 2) }}
                                        <del>{{$settings->currency_icon ?? ''}}{{ number_format($product->price, 2) }}</del>
                                    @else
                                        {{$settings->currency_icon ?? ''}}{{ number_format($product->price, 2) }}
                                    @endif
                                </p>


                               <!-- Add to Cart Form -->
                            {{-- <form class="shopping-cart-form" method="POST" action="" hidden>
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="qty" value="1">
                                <button class="add_cart" type="submit">Add to Cart</button>
                            </form> --}}
                            <form class="shopping-cart-form" method="POST" action="">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="quantity-selector" style="display: none; align-items: center; gap: 6px; margin-bottom: 8px;">
        <button type="button" class="qty-btn minus">-</button>
        <input class="number_area" name="qty" type="number" min="1" max="100" value="1" style="width: 45px; text-align: center;">
        <button type="button" class="qty-btn plus">+</button>
        <button type="submit" class="add_cart_button" style="margin-left:10px;">
            Add To Cart <i class="fa fa-shopping-cart"></i>
        </button>
    </div>
    <button type="button" class="show-qty-btn add_cart_button">
        Add To Cart <i class="fa fa-shopping-cart"></i>
    </button>
</form>

                            {{-- new add to cart --}}

                            {{-- <form class="shopping-cart-form" method="POST" action="">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="qty" value="1">
                            <button class="add_cart_button" type="submit">
                                Add To Cart <i class="fa fa-shopping-cart"></i>
                            </button>
                        </form>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                        <script>
                        $(document).ready(function() {
                        $('.shopping-cart-form').on('submit', function(e) {
                        e.preventDefault(); // Prevent form from reloading the page

                        var form = $(this);
                        var url = form.attr('action');
                        var data = form.serialize();

                        $.ajax({
                        url: url,
                        method: 'POST',
                        data: data,
                        success: function(response) {
                            // Update the cart count
                            $('#cart-count').text(response.cart_count);
                        },
                        error: function() {
                            alert('Something went wrong while adding to cart.');
                        }
                        });
                        });
                        });
                        </script> --}}



                            {{-- new add to cart end  --}}

                            </div>
                        </div>
                    </div>
                </div>
                @empty
                {{-- <div class="col-12">
                    <p class="text-center">No products available for Festival Wears.</p>
                </div> --}}
                @endforelse
            {{-- </div> --}}
        </div>
    </div>
</section>
{{-- </a> --}}
@endif

{{-- <div class="banner-container" style="display: flex; flex-wrap: nowrap; gap: 10px; margin-bottom: 30px; ">
    <!-- First Banner (Half width) -->
    @if(isset($homepage_secion_banner_three->banner_one) && isset($homepage_secion_banner_three->banner_one->banner_image) && isset($homepage_secion_banner_three->banner_one->banner_url))
        <a href="{{ $homepage_secion_banner_three->banner_one->banner_url }}" target="_blank"
           style="display: block; width: 50%; height: 420px; background-image: url('{{ asset($homepage_secion_banner_three->banner_one->banner_image) }}'); background-size: cover; background-position: center; border-top-right-radius: 16px;
    border-bottom-right-radius: 16px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    box-shadow: 0 6px 12px rgba(0, 0, 0,">
            <!-- Optional: You can add any text or additional information on top of the banner if needed -->
        </a>
    @endif

    <!-- Second and Third Banners (Stacked vertically) -->
    <div style="display: flex; flex-direction: column; width: 50%; gap: 10px;  ">
        <!-- Second Banner -->
        @if(isset($homepage_secion_banner_three->banner_two) && isset($homepage_secion_banner_three->banner_two->banner_image) && isset($homepage_secion_banner_three->banner_two->banner_url))
            <a href="{{ $homepage_secion_banner_three->banner_two->banner_url }}" target="_blank"
               style="display: block; height: 205px; background-image: url('{{ asset($homepage_secion_banner_three->banner_two->banner_image) }}'); background-size: cover; background-position: center; border-top-left-radius: 16px;
    border-bottom-left-radius: 16px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    box-shadow: 0 6px 12px rgba(0, 0, 0,">
            </a>
        @endif

        <!-- Third Banner -->
        @if(isset($homepage_secion_banner_three->banner_three) && isset($homepage_secion_banner_three->banner_three->banner_image) && isset($homepage_secion_banner_three->banner_three->banner_url))
            <a href="{{ $homepage_secion_banner_three->banner_three->banner_url }}" target="_blank"
               style="display: block; height: 205px; background-image: url('{{ asset($homepage_secion_banner_three->banner_three->banner_image) }}'); background-size: cover; background-position: center; border-top-left-radius: 16px;
    border-bottom-left-radius: 16px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    box-shadow: 0 6px 12px rgba(0, 0, 0,">
            </a>
        @endif
    </div>
</div> --}}
<div class="banner-container">
    <!-- Desktop View (Flex Layout) -->
    <div class="desktop-banners">
        @if(isset($homepage_secion_banner_three->banner_one))
            <a href="{{ $homepage_secion_banner_three->banner_one->banner_url }}" target="_blank"
               class="banner-slide"
               style="background-image: url('{{ asset($homepage_secion_banner_three->banner_one->banner_image) }}');">
            </a>
        @endif

        <div class="stacked-banners">
            @if(isset($homepage_secion_banner_three->banner_two))
                <a href="{{ $homepage_secion_banner_three->banner_two->banner_url }}" target="_blank"
                   class="banner-slide small-banner"
                   style="background-image: url('{{ asset($homepage_secion_banner_three->banner_two->banner_image) }}');">
                </a>
            @endif

            @if(isset($homepage_secion_banner_three->banner_three))
                <a href="{{ $homepage_secion_banner_three->banner_three->banner_url }}" target="_blank"
                   class="banner-slide small-banner"
                   style="background-image: url('{{ asset($homepage_secion_banner_three->banner_three->banner_image) }}');">
                </a>
            @endif
        </div>
    </div>

    <!-- Mobile View (Swiper Slider) -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            @if(isset($homepage_secion_banner_three->banner_one))
                <a href="{{ $homepage_secion_banner_three->banner_one->banner_url }}" target="_blank"
                   class="swiper-slide banner-slide"
                   style="background-image: url('{{ asset($homepage_secion_banner_three->banner_one->banner_image) }}');">
                </a>
            @endif

            @if(isset($homepage_secion_banner_three->banner_two))
                <a href="{{ $homepage_secion_banner_three->banner_two->banner_url }}" target="_blank"
                   class="swiper-slide banner-slide"
                   style="background-image: url('{{ asset($homepage_secion_banner_three->banner_two->banner_image) }}');">
                </a>
            @endif

            @if(isset($homepage_secion_banner_three->banner_three))
                <a href="{{ $homepage_secion_banner_three->banner_three->banner_url }}" target="_blank"
                   class="swiper-slide banner-slide"
                   style="background-image: url('{{ asset($homepage_secion_banner_three->banner_three->banner_image) }}');">
                </a>
            @endif
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<!-- Swiper Scripts -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        }
    });
</script>



{{-- new section added --}}


<section class="arrivels mt-4 mb-4">
    <div class="container">
        <div class="site-title text-center mb-3">
            <h3>All Products</h3>
        </div>
        <div class="homeProductCard" >
        {{-- <div class="homeProductCard customMobileSlide" > --}}
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4 gap-30"  >
                {{-- <div class="homeProductCard customMobileSlide" style=" margin: 0 auto;">
                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4" style="gap: 0px; justify-content: space-around; margin-left: 10px;"> --}}



                @forelse($festivalProducts as $product)
                <div class="col">
                    <div class="products_list_item" >
                        <div class="product_item position-relative">
                            <span class="new badge bg-primary position-absolute" style="top: 10px; left: 10px;">New</span>

                            <a class="pro_link" href="{{route('product-detail', $product->slug)}}">
                                <img src="{{ asset($product->thumb_image) }}"
                                     alt="{{ $product->name }}" class="img-fluid w-100 img_1">
                                <img src="{{ asset($product->thumb_image) }}"
                                     alt="{{ $product->name }}" class="img-fluid w-100 img_2">
                            </a>

                            <ul class="single_pro_icon">
                                <li>
                                    <a href="{{route('product-detail', $product->slug)}}" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                       class="show_product_modal" data-id="{{ $product->id }}">
                                        <i class="far fa-eye" aria-hidden="true"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('product-detail', $product->slug)}}" class="add_to_wishlist" data-id="{{ $product->id }}">
                                        <i class="far fa-heart" aria-hidden="true"></i>
                                    </a>
                                </li>
                            </ul>

                            <div class="product_details text-flex-start mt-3" style="justify-content: flex-start">
                                <a href="{{route('product-detail', $product->slug)}}" class="pro_name" title="{{ $product->name }}" style="justify-content: flex-start">
                                    {{ $product->name }}
                                </a>

                                 <!-- Review Section -->
                                 <div class="product_review mt-1 d-flex align-items-center" style="justify-content: flex-start; font-size: 12px;">
                                    <span class="rating" style="color: #f39c12; font-size: 12px; line-height: 1;">
                                       4.8 ⭐
                                    </span>
                                    <span class="review_count" style="margin-left: 5px; color: #555; font-size: 12px; line-height: 1;">
                                        ({{ $product->reviews_count ?? '0' }} reviews)
                                    </span>
                                </div>

                            <!-- Review Section -->
                                <p class="price mt-1" style="justify-content: flex-start">
                                    @if($product->offer_price)
                                        {{$settings->currency_icon ?? ''}}{{ number_format($product->offer_price, 2) }}
                                        <del>{{$settings->currency_icon ?? ''}}{{ number_format($product->price, 2) }}</del>
                                    @else
                                        {{$settings->currency_icon ?? ''}}{{ number_format($product->price, 2) }}
                                    @endif
                                </p>

                                {{-- <form class="shopping-cart-form d-none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1" min="1" max="100">
                                    <button class="add_cart btn btn-primary mt-2" type="submit">Add to Cart</button>
                                </form> --}}
                                <form class="shopping-cart-form" method="POST" action="">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="quantity-selector" style="display: none; align-items: center; gap: 8px; margin-bottom: 8px;">
        <button type="button" class="qty-btn minus" aria-label="Decrease quantity">−</button>
        <input class="number_area" name="qty" type="number" min="1" max="100" value="1" readonly style="width: 45px; text-align: center;">
        <button type="button" class="qty-btn plus" aria-label="Increase quantity">+</button>
        <button type="submit" class="add_cart_button" style="margin-left:10px;">
            Add To Cart <i class="fa fa-shopping-cart"></i>
        </button>
    </div>
    <button type="button" class="show-qty-btn add_cart_button">
        Add To Cart <i class="fa fa-shopping-cart"></i>
    </button>
</form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div>

        {{-- <div class="pagination-wrapper mt-4 d-flex justify-content-center">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm">

                    <!-- Example of 1 to 10 Pagination Buttons -->
                    @for ($page = 1; $page <= 10; $page++)
                        <li class="page-item {{ $page == request('page', 1) ? 'active' : '' }}">
                            <form method="GET" action="{{ request()->url() }}" style="display: inline;">
                                <input type="hidden" name="page" value="{{ $page }}">
                                <button type="submit" class="page-link" style="border: 1px solid #ddd; padding: 6px 12px; background: {{ $page == request('page', 1) ? '#007bff' : '#fff' }}; color: {{ $page == request('page', 1) ? '#fff' : '#007bff' }};">
                                    {{ $page }}
                                </button>
                            </form>
                        </li>
                    @endfor

                </ul>
            </nav>
        </div> --}}

        <!-- Optional CSS for cleaner look -->


        <style>
            .pagination-wrapper {
                margin-top: 20px;
            }

            .pagination {
                display: flex;
                gap: 5px;
                padding: 0;
                list-style: none;
                align-items: center;
            }

            .pagination .page-item {
                list-style: none;
            }

            .pagination .page-item form {
                margin: 0;
                display: inline-block;
            }

            .pagination .page-link {
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .pagination .page-item.active .page-link {
                background-color: #007bff;
                color: white;
                border-color: #007bff;
            }

            .pagination .page-link:hover {
                background-color: #f1f1f1;
            }

            /* Media Query for Tablets (landscape and portrait) */
@media (max-width: 768px) {
    .pagination {
        gap: 3px;
    }

    .pagination .page-link {
        padding: 5px 10px;
        font-size: 12px; /* Smaller text for tablets */
    }
}

/* Media Query for Mobile Phones */
@media (max-width: 480px) {
    .pagination {
        justify-content: center; /* Center align for mobile */
        gap: 2px;
    }

    .pagination .page-link {
        padding: 4px 8px;
        font-size: 12px; /* Even smaller text for smaller devices */
    }
}
        </style>



    </div>
</section>



{{-- new section all product --}}







{{-- shop by category --}}

<style>
    .heading-shop-by-brand {
        text-align: center;
        margin-bottom: 20px;
        font-weight: 700;
        font-size: 24px;
        text-transform: uppercase;
        color: green;
        letter-spacing: 1px;
        margin: 1rem auto 1.5rem;
    }

    .brands-slider-container {
        width: 100%;
        overflow: hidden;
        position: relative;
    }

    .brands-container-category {
        display: flex;
        transition: transform 0.5s ease;
        gap: 30px;
        padding: 20px;
        /* background-color: #f3faf2; */
        will-change: transform;
    }

    .badge-category {
        min-width: 180px;
        height: 180px;
        border: 3px solid #8bc34a;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        background-color: white;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        flex-shrink: 0;
        overflow: hidden;
    }

    .badge-category:hover {
        transform: scale(1.05);
    }

    .badge-icons-category {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: absolute;
        top: 0;
        left: 0;
    }

    .badge-icons-category img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 50%;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .badge-category {
            min-width: 120px;
            height: 120px;
        }
    }

    @media (max-width: 480px) {
        .brands-container-category {
            display: flex;
            flex-wrap: wrap;
            padding: 10px;
            gap: 10px;
        }

        .badge-category {
            min-width: 100px;
            height: 100px;
        }
    }
</style>

{{-- <div class="heading-shop-by-brand">
    SHOP BY BRAND
</div> --}}

{{-- <div class="banner-container" style="display: flex; justify-content: space-between; margin-bottom: 30px;">
    <!-- Banner One -->
    @if(isset($homepage_secion_banner_two->banner_one) && isset($homepage_secion_banner_two->banner_one->banner_image) && isset($homepage_secion_banner_two->banner_one->banner_url))
        <a href="{{ $homepage_secion_banner_two->banner_one->banner_url }}" target="_blank"
           style="display: block; width: 48%; height: 300px; background-image: url('{{ asset($homepage_secion_banner_two->banner_one->banner_image) }}'); background-size: cover; background-position: center;">
            <!-- Optional: You can add any text or additional information on top of the banner if needed -->
        </a>
    @else
        <!-- Fallback content if banner one is missing -->
        <div style="display: block; width: 48%; height: 300px; background-color: #ddd; text-align: center; line-height: 300px;  border-top-right-radius: 16px;
    border-bottom-right-radius: 16px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;

    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    overflow: hidden;">
            No Banner Available
        </div>
    @endif

    <!-- Banner Two -->
    @if(isset($homepage_secion_banner_two->banner_two) && isset($homepage_secion_banner_two->banner_two->banner_image) && isset($homepage_secion_banner_two->banner_two->banner_url))
        <a href="{{ $homepage_secion_banner_two->banner_two->banner_url }}" target="_blank"
           style="display: block; width: 48%; height: 300px; background-image: url('{{ asset($homepage_secion_banner_two->banner_two->banner_image) }}'); background-size: cover; background-position: center;">
            <!-- Optional: You can add any text or additional information on top of the banner if needed -->
        </a>
    @else
        <!-- Fallback content if banner two is missing -->
        <div style="display: block; width: 48%; height: 300px; background-color: #ddd; text-align: center; line-height: 300px;
        border-radius: 16px;

    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    overflow: hidden;">
            No Banner Available
        </div>
    @endif
</div> --}}

{{-- new update --}}
<div class="banner-container">
    <!-- Desktop Banners -->
    <div class="desktop-banners">
        <!-- Banner One -->
        @if(isset($homepage_secion_banner_two->banner_one) && isset($homepage_secion_banner_two->banner_one->banner_image) && isset($homepage_secion_banner_two->banner_one->banner_url))
            <a href="{{ $homepage_secion_banner_two->banner_one->banner_url }}" target="_blank"
               class="banner-slide-2"
               style="background-image: url('{{ asset($homepage_secion_banner_two->banner_one->banner_image) }}');">
            </a>
        @else
            <div class="fallback-banner">No Banner Available</div>
        @endif

        <!-- Banner Two -->
        @if(isset($homepage_secion_banner_two->banner_two) && isset($homepage_secion_banner_two->banner_two->banner_image) && isset($homepage_secion_banner_two->banner_two->banner_url))
            <a href="{{ $homepage_secion_banner_two->banner_two->banner_url }}" target="_blank"
               class="banner-slide-2"
               style="background-image: url('{{ asset($homepage_secion_banner_two->banner_two->banner_image) }}');">
            </a>
        @else
            <div class="fallback-banner">No Banner Available</div>
        @endif
    </div>

    <!-- Mobile Swiper Slider -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <!-- Banner One -->
            @if(isset($homepage_secion_banner_two->banner_one))
                <a href="{{ $homepage_secion_banner_two->banner_one->banner_url }}" target="_blank"
                   class="swiper-slide"
                   style="background-image: url('{{ asset($homepage_secion_banner_two->banner_one->banner_image) }}');">
                </a>
            @endif

            <!-- Banner Two -->
            @if(isset($homepage_secion_banner_two->banner_two))
                <a href="{{ $homepage_secion_banner_two->banner_two->banner_url }}" target="_blank"
                   class="swiper-slide"
                   style="background-image: url('{{ asset($homepage_secion_banner_two->banner_two->banner_image) }}');">
                </a>
            @endif
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            769: {
                slidesPerView: "auto",
                loop: false,
                autoplay: false,
            }
        }
    });
</script>
<style>
    /* Default styles */
.banner-container {
    margin-bottom: 30px;
}

/* Desktop Layout */
.desktop-banners {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.banner-slide-2 {
    display: block;
    width: 48%;
    height: 300px !important;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    border-radius: 16px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Fallback Banner */
.fallback-banner {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 48%;
    height: 300px;
    background-color: #ddd;
    text-align: center;
    font-weight: bold;
    border-radius: 16px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Hide Swiper on Desktop */
.swiper-container {
    display: none;
}

/* Mobile Version */
@media (max-width: 768px) {
    .desktop-banners {
        display: none;
    }

    .swiper-container {
        display: block;
        overflow: hidden;
    }

    .swiper-slide {
        width: 100% !important;
        height: auto !important;
        min-height: 220px; /* Ensures better spacing */
        display: flex;
        justify-content: center;
        align-items: center;
        background-size: contain; /* Prevents cropping */
        background-repeat: no-repeat;
        background-position: center;
    }
}

/* Special Case for 448px Screens */
@media (max-width: 448px) {
    .swiper-slide {
        min-height: 180px !important;
        height: auto !important;
    }
}

</style>

{{-- new update --}}

<div class="heading-shop-by-brand">
    SHOP BY BRAND
</div>

<div class="brands-slider-container">
    <div class="brands-container-category" id="brandsContainer">
        @foreach ($brands as $brand)
            <div class="badge-category">
                <div class="badge-icons-category" onclick="window.location.href='{{ route('brand.product', ['id' => $brand->id]) }}'">
                    @php
                        $brandLogo = $brand->logo ?? asset('path/to/default-image.png');
                    @endphp
                    <img src="{{ $brand->logo ? $brand->logo : asset('path/to/default-image.png') }}"
                         alt="Brand Icon"
                         onerror="this.onerror=null;this.src='{{ asset('https://cdn-icons-png.flaticon.com/512/5553/5553901.png') }}';">
                </div>
            </div>
        @endforeach
    </div>
</div>


<script>
   const container = document.getElementById('brandsContainer');
let currentPosition = 0;
let cardWidth = 0;
let interval;

// Function to render the slider
function renderBrands() {
    const cards = document.querySelectorAll('.badge-category');
    if (cards.length > 0) {
        cardWidth = cards[0].offsetWidth + 20; // Card width + gap
    }
}

// Function to center brands if there are 4 or fewer
function centerBrands() {
    const cards = document.querySelectorAll('.badge-category');
    const containerWidth = container.offsetWidth;
    const totalCardsWidth = cards.length * cardWidth;

    if (totalCardsWidth < containerWidth) {
        const emptySpace = containerWidth - totalCardsWidth;
        const offset = emptySpace / 2;

        container.style.transition = 'none';
        container.style.transform = `translateX(${offset}px)`;
    }
}

// Auto-slide logic for more than 4 brands
function autoSlide() {
    currentPosition -= cardWidth;
    container.style.transition = 'transform 0.5s ease';
    container.style.transform = `translateX(${currentPosition}px)`;

    const totalWidth = container.scrollWidth / 2;

    if (Math.abs(currentPosition) >= totalWidth) {
        setTimeout(() => {
            container.style.transition = 'none';
            currentPosition = 0;
            container.style.transform = `translateX(${currentPosition}px)`;
        }, 500);
    }
}

// Initialize slider logic based on brand count
function startSlider() {
    const cards = document.querySelectorAll('.badge-category');
    const brandCount = cards.length;

    renderBrands();

    if (brandCount > 4) {
        clearInterval(interval);
        interval = setInterval(autoSlide, 3000);
        container.style.justifyContent = 'flex-start';
    } else {
        clearInterval(interval);
        currentPosition = 0;
        container.style.transform = 'translateX(0)';
        container.style.transition = 'none';

        setTimeout(centerBrands, 100);
    }
}

// Initial setup
startSlider();
window.addEventListener('resize', () => {
    currentPosition = 0;
    startSlider();
});

</script>











{{-- end shop by category --}}





{{-- end shop by category --}}



 <!--============================
       FLASH SALE  START
    ==============================-->
{{-- @if($flashSaleActive)
@include('frontend.home.sections.flash-sale')
@endif --}}

<!--============================
       FLASH SALE END
    ==============================-->

    <!--============================
       MONTHLY TOP PRODUCT START
    ==============================-->
    {{-- @include('frontend.home.sections.top-category-product') --}}
    <!--============================
       MONTHLY TOP PRODUCT END
    ==============================-->


    <!--============================
        BRAND SLIDER START
    ==============================-->
    {{-- @include('frontend.home.sections.brand-slider') --}}
    <!--============================
        BRAND SLIDER END
    ==============================-->


    <!--============================
        SINGLE BANNER START
    ==============================-->
    {{-- @include('frontend.home.sections.single-banner') --}}
    <!--============================
        SINGLE BANNER END
    ==============================-->


    <!--============================
        HOT DEALS START
    ==============================-->
    {{-- @include('frontend.home.sections.hot-deals') --}}
    <!--============================
        HOT DEALS END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    {{-- @include('frontend.home.sections.category-product-slider-one') --}}
    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    {{-- @include('frontend.home.sections.category-product-slider-two') --}}

    <!--============================
        ELECTRONIC PART END
    ==============================-->



    <!--============================
        WEEKLY BEST ITEM START
    ==============================-->
    {{-- @include('frontend.home.sections.weekly-best-item') --}}
    <!--============================
        WEEKLY BEST ITEM END
    ==============================-->


    <!--============================
        LARGE BANNER  START
    ==============================-->
    {{-- @include('frontend.home.sections.large-banner') --}}

    <!--============================
        LARGE BANNER  END
    ==============================-->


    <!--============================
        HOME BLOGS START
    ==============================-->
    @include('frontend.home.sections.blog')
    <!--============================
        HOME BLOGS END
    ==============================-->

    <!--============================
      HOME SERVICES START
    ==============================-->
    @include('frontend.home.sections.services')
    <!--============================
        HOME SERVICES END
    ==============================-->

<style>
    .fashionistas_row{
        grid-gap: 0px !important;
    }

    .products_list_item:hover {
        transform: translateY(2px);
    }

</style>




<style>

  .store-container123 {
    display: flex;
    gap: 15px !important;
    margin-top: 50px;
    flex-wrap: wrap;
}

.store-card {
    width: 250px;
    height: 300px;
    background-color: #f7f7f7;
    border-radius: 16px;
    text-align: center;
    padding: 50px 15px 20px;
    position: relative;
    transition: transform 0.3s ease-in-out;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    overflow: visible;
    flex-shrink: 0;
    margin-bottom: 10px;
}

.store-card:hover {
    transform: translateY(-5px);
}

/* Floating logo */
.store-header {
    position: absolute;
    top: -40px;
    left: 50%;
    transform: translateX(-50%);
    background-color: whitesmoke;
    border-radius: 50%;
    width: 150px;
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    z-index: 2;
}

.store-logo {
    width: 120px !important;

    height: 120px !important;
    border-radius: 50%;
    object-fit: cover;
}

.store-body {
    margin-top: 70px;
}

.store-name {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin: 10px 0;
}

.delivery-time {
    font-size: 14px;
    color: #666;
}

.discount-btn {
    background-color: #f36f36;
    color: white;
    font-size: 14px;
    padding: 5px 10px;
    border: none;
    border-radius: 20px;
    margin: 10px 0;
    cursor: pointer;
}

.product-images {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 10px;
}

/* Larger product images */
.product-images img {
    width: 60px;
    height: 60px;
    border-radius: 30%;
    object-fit: cover;
}

/* Tablet (2 cards per row) */
@media (max-width: 768px) {
    .store-container123 {
        justify-content: center;
    }
    .store-card {
        width: 45%; /* 2 cards in a row */
        height: auto;
        padding: 40px 15px 20px;
    }

    .store-header {
        width: 120px;
        height: 120px;
        top: -30px;
    }

    .store-logo {
        width: 90px;
        height: 90px;
    }

    .product-images img {
        width: 50px;
        height: 50px;
    }
}

/* Mobile (1 card per row) */
@media (max-width: 480px) {
    .store-container123 {
        flex-direction: column;
        align-items: center;
    }

    .store-card {
        width: 90%; /* Full width for mobile */
        max-width: 320px; /* Optional max width for better look */
        padding: 30px 15px 20px;
    }

    .store-header {
        width: 100px;
        height: 100px;
        top: -20px;
    }

    .store-logo {
        width: 80px;
        height: 80px;
    }

    .product-images img {
        width: 40px;
        height: 40px;
    }

    .store-name {
        font-size: 16px;
    }

    .discount-btn {
        font-size: 12px;
        padding: 4px 8px;
    }
}

/* Large screens (3 or more cards per row) */
/* @media (min-width: 1024px) {
    .store-card {
        width: 250px;
    }
} */



@media (max-width: 1024px) {
    .store-container123 {
        justify-content: center; /* Center items if they don't fit */
        gap: 10px; /* Reduce gap to save space */
    }

    .store-card {
        width: 160px; /* Slightly smaller cards */
        height: 280px;
        padding: 40px 10px 15px; /* Adjust padding */
    }

    .store-header {
        width: 120px; /* Smaller floating logo */
        height: 120px;
    }

    .store-logo {
        width: 100px !important;
        height: 100px !important;
    }

    .store-name {
        font-size: 16px; /* Slightly smaller font */
    }

    .delivery-time {
        font-size: 12px;
    }

    .product-images img {
        width: 25px; /* Smaller images */
        height: 25px; /* Maintain square aspect */
    }
}

/* iPad Mini, iPad Air, iPad Pro 11" - Portrait */
@media (min-width: 768px) and (max-width: 834px) {
    .store-container123 {
        justify-content: center;
    }

    .store-card {
        width: 150px; /* 2 cards per row */
        height: auto;
        padding: 40px 15px 20px;
    }

    .store-header {
        width: 120px;
        height: 120px;
        top: -30px;
    }

    .store-logo {
        width: 90px;
        height: 90px;
    }

    .store-name {
        font-size: 16px;
    }

    .delivery-time {
        font-size: 12px;
    }

    .product-images img {
        width: 25px;
        height: 25px;
    }
}

/* iPad Pro 12.9" (larger screen but might want tighter layout) */
@media (min-width: 835px) and (max-width: 1024px) {
    .store-container123 {
        justify-content: center;
        gap: 12px; /* Adjust gap to fit more */
    }

    .store-card {
        width: 160px; /* Slightly smaller cards */
        height: 280px;
        padding: 40px 15px 15px;
    }

    .store-header {
        width: 130px;
        height: 130px;
        top: -35px;
    }

    .store-logo {
        width: 100px;
        height: 100px;
    }

    .store-name {
        font-size: 17px;
    }

    .delivery-time {
        font-size: 13px;
    }

    .product-images img {
        width: 25px;
        height: 25px;
    }
}






</style>

<style>

    .shopping-cart-form {
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top: 12px;
    }

    .add_cart_button {
        background-color: #e7f6e7; /* light green background */
        color: #137333; /* darker green text */
        font-weight: 600;
        border: none;
        padding: 12px 20px;
        border-radius: 24px;
        display: flex;
        align-items: center;
        gap: 8px; /* spacing between text and icon */
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        outline: none;
    }

    .add_cart_button:hover {
        background-color: #d2ebd2; /* slightly darker green on hover */
    }

    .add_cart_button i {
        font-size: 16px;
        color: #137333; /* matching icon color */
    }

    .product_item {
        border: 1px solid lightgrey; /* No border by default */
        border-radius: 8px; /* Optional if you want rounded corners */
        transition: transform 0.3s ease-in-out, border-color 0.3s ease-in-out;
    }

    .product_item:hover {
        transform: translateY(-5px); /* Slight lift effect */
        border-color: #137333; /* Green border on hover */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Optional shadow */
    }

/* ===== Media Queries ===== */

/* Tablet and Small Laptops */
@media (max-width: 768px) {
    .add_cart_button {
        padding: 10px 16px;
        font-size: 13px;
        gap: 6px;
        border-radius: 20px;
    }

    .add_cart_button i {
        font-size: 14px;
    }

    .shopping-cart-form {
        margin-top: 8px;
    }
}

/* Mobile Phones */
@media (max-width: 576px) {
    .add_cart_button {
        padding: 8px 12px;
        font-size: 12px;
        gap: 4px;
        border-radius: 18px;
    }

    .add_cart_button i {
        font-size: 12px;
    }

    .shopping-cart-form {
        margin-top: 6px;
    }
}

/* Very Small Devices (Small Phones - like 360px and below) */
@media (max-width: 360px) {
    .add_cart_button {
        padding: 6px 10px;
        font-size: 11px;
        gap: 3px;
        border-radius: 16px;
    }

    .add_cart_button i {
        font-size: 11px;
    }

    .shopping-cart-form {
        margin-top: 4px;
    }
}

    </style>


{{-- all product card --}}
    <style>


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



    </style>


<style>

 /* Default styles */
.banner-container {
    margin-bottom: 30px;
}

/* Desktop Layout */
.desktop-banners {
    display: flex;
    flex-wrap: nowrap;
    gap: 10px;
}

.banner-slide {
    display: block;
    width: 50%;
    height: 420px;
    background-size: cover;
    background-position: center;
    border-radius: 16px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.stacked-banners {
    display: flex;
    flex-direction: column;
    gap: 10px;
    width: 50%;
}

.small-banner {
    width: 100%;
    height: 205px;
}

/* Hide Swiper on Desktop */
.swiper-container {
    display: none;
}

.swiper-pagination {
    visibility: hidden !important;
    opacity: 0;
    pointer-events: none; /* Prevents interaction */
}

/* update */
/* @media (max-width: 1024px) {
    .banner-slide {
        width: 70%;
        height: 350px;
    }
}

@media (max-width: 768px) {
    .banner-slide {
        width: 100%;
        height: 300px;
        background-size: contain !important;
    }
} */

/* @media (max-width: 480px) {
    .banner-slide {
        width: 100%;
        height: 300px;
        border-radius: 12px;
        background-size: contain !important;
    }
} */



/* update */


@media (min-width: 768px) and (max-width: 1024px) {
    .product_item {
        width: 160px; /* Slightly larger for better tablet appearance */
        height: auto !important;
        /* padding: 12px; */
        border: 1px solid rgba(0, 0, 0, 0.2);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        background: #fff;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    /* .product_item .pro_link {
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
    padding: 10px;
} */
}



@media (min-width: 768px) and (max-width: 1024px) {
    .add_cart_button {
        padding: 8px 10px;
        font-size: 11px;
        border-radius: 8px;
        gap: 5px;
    }
        .product_item .pro_link img {
    width: 100%;
    height: 300px;
}
}

@media (min-width: 1025px) and (max-width: 1366px) {
    .product_item {
        width: 220px; /* Bigger product card for larger screens */
        /* padding: 16px; */
        font-size: 16px;
    }

    .product_item .pro_link img {
    width: 100%;
    height: 300px;
}

    .add_cart_button {
        padding: 12px 16px;
        font-size: 14px;
        border-radius: 16px;
        gap: 8px;
    }
    .product_item .pro_link {
    position: relative;
    width: 100%;
    height: auto;
    overflow: hidden;
    padding: 10px;
}
}


/* Mobile Version */
@media (max-width: 768px) {
    .desktop-banners {
        display: none;
    }

    .swiper-container {
        display: block;
        overflow: hidden;
    }

    /* .swiper-slide {
        width: 100% !important;
        height: 180px !important;
        object-fit:inherit !important;
        border-radius: 0px !important;
    } */
    .swiper-slide {
        width: 100% !important;
        height: 200px !important; /* Ensures all slides have the same height */
        display: flex;
        align-items: center; /* Centers images if they are smaller */
        justify-content: center;
        background-color: #f8f8f8; /* Optional: Adds a background if images don’t cover the area */
    }

    .swiper-slide img {
        width: 100%;
        max-height: 100%; /* Ensures images do not exceed the slide height */
        object-fit: contain !important; /* Keeps full image visible */
        border-radius: 0px !important;
    }

}
/* Special Case for 448px Screens */
@media (max-width: 448px) {
    /* .swiper-slide {
        min-height: 250px !important;
        height: auto !important;
    } */
    .swiper-slide {
        height: 180px !important; /* Adjusted for smaller screens */
        object-fit: contain !important;
    }

    .swiper-slide img {
        max-height: 100%;
        object-fit: contain !important;
    }

    .banner-slide {

    background-size: cover !important;
    /* object-fit: cover !important; */
    border-radius: 0px;


}

/* .swiper-slide:nth-child(1) {
        height: 100px !important;
        background-size: contain !important;
        background-repeat: no-repeat;
    } */



.banner-slide:nth-child(2),
.banner-slide:nth-child(3) {
    padding: 120px !important;
    background-size: contain !important;
}

    /* .swiper-slide img {
        border-radius: 0px !important;
        width: 100%;
        object-fit: inherit !important;

    } */

}

.quantity-selector {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
    justify-content: center;
}
.qty-btn {
    background: #e7f6e7;
    border: none;
    color: #137333;
    font-size: 20px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.qty-btn:hover {
    background: #d2ebd2;
}
.number_area {
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 2px 0;
    text-align: center;
    width: 45px;
    font-size: 16px;
    background: #fff;
    color: #333;
    font-weight: 600;
}

    </style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.shopping-cart-form').forEach(function(form) {
        const showQtyBtn = form.querySelector('.show-qty-btn');
        const qtySelector = form.querySelector('.quantity-selector');
        if (showQtyBtn && qtySelector) {
            showQtyBtn.addEventListener('click', function() {
                showQtyBtn.style.display = 'none';
                qtySelector.style.display = 'flex';
            });
        }
        // Plus/minus logic
        const minus = form.querySelector('.qty-btn.minus');
        const plus = form.querySelector('.qty-btn.plus');
        const input = form.querySelector('input[name="qty"]');
        if (minus && plus && input) {
            minus.onclick = function() {
                let val = parseInt(input.value) || 1;
                if (val > 1) input.value = val - 1;
            };
            plus.onclick = function() {
                let val = parseInt(input.value) || 1;
                if (val < 100) input.value = val + 1;
            };
        }
    });
});
</script>




@endsection
