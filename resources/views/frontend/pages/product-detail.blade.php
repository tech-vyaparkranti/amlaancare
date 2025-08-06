@extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name??""}} || Product Details
@endsection
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

@section('content')

    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('shop') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">product</a></li>
                <li><a href="#">product details</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PRODUCT DETAILS START
    ==============================-->
    <section id="product_details" class="mt-4 mb-4">
        <div class="container">
            <div class="details_bg">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="title mobile-title" hidden>{{$product->name}}</h1>
                        @if ($product->qty > 0)
                            <p class="stock_area mb-2 visible" hidden><span class="in_stock">in stock</span> ({{$product->qty}} item)</p>
                        @elseif ($product->qty === 0)
                            <p class="stock_area mb-2 visible" hidden><span class="out_stock">stock out</span> ({{$product->qty}} item)</p>
                        @endif
                        <div id="sticky_pro_zoom">
                            <div class="exzoom hidden" id="exzoom">
                                <div class="exzoom_img_box" style="position: relative;">
                                    @if ($product->video_link)
                                    <a class="venobox pro_det_video" data-autoplay="true" data-vbtype="video" href="{{$product->video_link}}">
                                        <i class="fas fa-play" style="margin-top: 10px;"></i>
                                    </a>
                                    @endif
                                    <ul class="exzoom_img_ul" style="padding: 0; margin: 0; list-style: none; display: flex; overflow-x: auto; scroll-snap-type: x mandatory;">
                                        <li style="flex-shrink: 0; scroll-snap-align: center;">
                                            <img class="zoom ing-fluid w-100" src="{{asset($product->thumb_image)}}" alt="product" style="width: 100%; height: auto;">
                                        </li>
                                        @foreach ($product->productImageGalleries as $productImage)
                                        <li style="flex-shrink: 0; scroll-snap-align: center;">
                                            <img class="zoom ing-fluid w-100" src="{{asset($productImage->image)}}" alt="product" style="width: 100%; height: auto;">
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> <i class="far fa-chevron-left"></i> </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> <i class="far fa-chevron-right"></i> </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="background-color: #f8f9fa; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); padding: 10px; border-radius: 10px; width:600px;  ">
                        <div class="pro_details_text">
                            <a class="title" href="javascript:;">{{$product->name}}</a>
                            {{-- @if ($product->qty > 0)
                            <p class="stock_area"><span class="in_stock">in stock</span> ({{$product->qty}} item)</p>
                            @elseif ($product->qty === 0)
                            <p class="stock_area"><span class="in_stock">stock out</span> ({{$product->qty}} item)</p>
                            @endif --}}
                            {{-- @if ($product->qty>0)
                                <p class="stock_area"><span class="in_stock">in stock</span></p>
                            @else
                                <p class="stock_area"><span class="out_stock">out of stock</span></p>
                            @endif --}}
                            @if (checkDiscount($product))
                                <div class="price">
                                    <label id="offer_price"><span class="currency_icon">{{$settings->currency_icon ?? ''}}</span>{{$product->offer_price}}</label>
                                    <label id="del_price"><span class="currency_icon">{{$settings->currency_icon ?? ''}}</span>{{$product->price}}</label>
                                    @if ($product->qty > 0)
                                        <label class="stock_area">
                                            <span class="in_stock">in stock</span>
                                            <span class="in_stock_gty">({{$product->qty}} item)</span>
                                        </label>
                                    @elseif ($product->qty === 0)
                                        <label class="stock_area">
                                            <span class="out_stock">stock out</span>
                                            <span class="in_stock_gty">({{$product->qty}} item)</span>
                                        </label>
                                    @endif
                                </div>
                            @else
                            <div class="price">
                                <label id="price">
                                    @if($product->offer_price)
                                        <span class="currency_icon">{{$settings->currency_icon ?? ''}}</span>{{ number_format($product->offer_price, 2) }}
                                        <del>
                                            <span class="currency_icon">{{$settings->currency_icon ?? ''}}</span>{{ number_format($product->price, 2) }}
                                        </del>
                                    @else
                                        <span class="currency_icon">{{$settings->currency_icon ?? ''}}</span>{{ number_format($product->price, 2) }}
                                    @endif
                                </label>
                            </div>

                            @endif
                            <p class="pro_rating">
                                @php
                                    $avgRating = $product->reviews()->avg('rating');
                                    $fullRating = round($avgRating);
                                @endphp
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $fullRating)
                                    <i class="fas fa-star"></i>
                                    @else
                                    <i class="far fa-star"></i>
                                    @endif
                                @endfor

                                <span>({{count($product->reviews)}} review)</span>
                            </p>
                           <p class="description">{!! $product->short_description !!}</p>

                            <form class="shopping-cart-form" enctype="multipart/form-data" >
                                <div class="selectbox">
                                    <div class="row">
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        @foreach ($product->variants as $variant)
                                        @if ($variant->status != 0)
                                            <div class="col-xl-6 col-sm-6 mt-2 mb-2">
                                                <h5 class="mb-2 pdp-title">{{$variant->name}}: </h5>
                                                <select required class="form-control"  name="variants_items[]">
                                                    <option value="">Select</option>
                                                    @foreach ($variant->productVariantItems as $variantItem)
                                                        @if ($variantItem->status != 0)
                                                            <option value="{{$variantItem->id}}" >{{$variantItem->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        @endforeach

                                    </div>
                                </div>


                                <div class="products-ingrediants">
                                    <li><img src="../frontend/images/gluten-free-preview.png" alt="" width="" height="" class="img-fluid" /></li>
                                    <li><img src="../frontend/images/lab-tested-preview.png" alt="" width="" height="" class="img-fluid" /></li>
                                    <li><img src="../frontend/images/performance-preview.png" alt="" width="" height="" class="img-fluid" /></li>
                                    <li><img src="../frontend/images/preservatives-preview.png" alt="" width="" height="" class="img-fluid" /></li>
                                    <li><img src="../frontend/images/synthetic-preview.png" alt="" width="" height="" class="img-fluid" /></li>
                                    <li><img src="../frontend/images/two-years-preview.png" alt="" width="" height="" class="img-fluid" /></li>
                                </div>

                                <div class="quentity">
                                    <h5 class="pdp-title">quantity :</h5>
                                    <div class="select_number">
                                        <input class="number_area" name="qty" type="text" min="1" max="100" value="1" />
                                    </div>

                                </div>
                                {{-- @include("frontend.pages.Product-details-parts.take_name")
                                @include("frontend.pages.Product-details-parts.productFonts")
                                @include("frontend.pages.Product-details-parts.product_texture_colours") --}}
                                @include("frontend.pages.Product-details-parts.product_zip_colours")
                                {{-- @include("frontend.pages.Product-details-parts.take_inside_text")
                                @include("frontend.pages.Product-details-parts.custom_design_option")
                                @include("frontend.pages.Product-details-parts.gift_wrap_option")
                                @include("frontend.pages.Product-details-parts.rush_service")
                                @include("frontend.pages.Product-details-parts.special_instructions") --}}


                                <ul class="button_area pdp_button_area">
                                    <li><span class="add_to_wishlist" data-id="{{$product->id}}"><i class="fal fa-heart"></i></span></li>
                                    <li><button type="submit" class="add_cart" href="#">add to cart</button></li>
                                    <li><button type="button" class="comment_btn"  data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="far fa-comment-alt"></i></button></li>
                                </ul>
                            </form>
                            <p class="brand_model"><span class="pdp-title">brand :</span> {{$product->brand->name}}</p>
                            <!-- Button that triggers the modal -->
                            {{-- <div class="product-info">
                                <button class="know-product-btn" id="openModalBtn">Know Your Product</button>
                                <button class="tracing-product-btn" id="tracingProductBtn">Tracing of Product</button>
                            </div> --}}

                            <div id="tracingModal" class="modal">
                                <div class="modal-content">
                                    <span class="close-btn" id="closeModalBtn">&times;</span>
                                    <h2>Product Tracing</h2>
                                    <div id="map" style="width: 100%; height: 500px;"></div>
                                </div>
                            </div>


<!-- Modal -->
<div id="productModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn1">&times;</span>
        <h2>Enter Your Details</h2>
        <form id="productForm">
            <!-- Hidden inputs for product_name and vendor_id -->
            <input type="hidden" id="product_name" name="product_name" value="{{ $product->name }}">
            <input type="hidden" id="vendor_id" name="vendor_id" value="{{ $product->vendor->id }}">
            <input type="hidden" id="certificate_url" name="certificate_url" value="{{ $certificateUrl }}">

            <!-- Name input field -->
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your name" required><br><br>

            <!-- Phone input field -->
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required><br><br>

            <!-- Download button (disabled by default) -->
            <button type="submit" id="downloadBtn" disabled>Download Now</button>
        </form>
    </div>
</div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12">
                    <div class="pro_det_description">
                        <div class="details_bg">
                            <ul class="nav nav-pills mb-3" id="pills-tab3" role="tablist" style="padding-bottom: 10px; gap: 5px">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab7" data-bs-toggle="pill"
                                        data-bs-target="#pills-home22" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">Description</button>
                                </li>

                                {{-- <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Vendor Info</button>
                                </li> --}}
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab2" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact2" type="button" role="tab"
                                        aria-controls="pills-contact2" aria-selected="false">Reviews</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent4">
                                <div class="tab-pane fade  show active " id="pills-home22" role="tabpanel"
                                    aria-labelledby="pills-home-tab7">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="description_area">
                                                {!!$product->long_description!!}
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="pro_det_vendor">
                                        <div class="row">
                                            <div class="col-xl-6 col-xxl-5 col-md-6">
                                                <div class="vebdor_img">
                                                    <img src="{{asset($product->vendor->banner)}}" alt="vensor" class="img-fluid w-100">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-xxl-7 col-md-6 mt-4 mt-md-0">
                                                <div class="pro_det_vendor_text">
                                                    <h4>{{$product->vendor->user->name}}</h4>
                                                    <p class="rating">
                                                        @php
                                                        $avgRating = $product->reviews()->avg('rating');
                                                        $fullRating = round($avgRating);
                                                        @endphp

                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $fullRating)
                                                            <i class="fas fa-star"></i>
                                                            @else
                                                            <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor

                                                        <span>({{count($product->reviews)}} review)</span>
                                                    </p>
                                                    <p><span>Store Name:</span> {{$product->vendor->shop_name}}</p>
                                                    <p><span>Address:</span> {{$product->vendor->address}}</p>
                                                    <p><span>Phone:</span> {{$product->vendor->phone}}</p>
                                                    <p><span>mail:</span> {{$product->vendor->email}}</p>
                                                    <a href="vendor_details.html" class="see_btn">visit store</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="vendor_details">
                                                    {!!$product->vendor->description!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                                    aria-labelledby="pills-contact-tab2">
                                    <div class="pro_det_review">
                                        <div class="pro_det_review_single">
                                            <div class="row">
                                                <div class="col-xl-8 col-lg-7">
                                                    <div class="comment_area">

                                                        {{-- <button>Give Review </button> --}}

                                                         {{-- Review Button part --}}
                                                    {{-- <button id="giveReviewBtn" style="background-color: rgb(182, 236, 209); color: black; padding: 8px 10px; border: none; cursor: pointer; border-radius: 5px; transition: background-color 0.3s;">
                                                        Give Review
                                                    </button> --}}


                                                    <div id="reviewPopup" class="popup-overlay">
                                                        <div class="popup-content">
                                                            <h3>Give Your Review</h3>

                                                            <form action="{{route('user.review.create')}}" enctype="multipart/form-data" method="POST">
                                                                @csrf


                                                                <label for="rating">Rating :</label>
                                                                <select name="rating" id="rating" required>
                                                                    <option value="">Select Rating</option>
                                                                    <option value="1">1 Star</option>
                                                                    <option value="2">2 Stars</option>
                                                                    <option value="3">3 Stars</option>
                                                                    <option value="4">4 Stars</option>
                                                                    <option value="5">5 Stars</option>
                                                                </select>

                                                <!-- Image Upload (Replaces Review Input) -->
                                                <label for="reviewImages">Select Images (Max 4):</label>
                                                <input type="file" name="images[]" id="reviewImages" accept="image/*" multiple required>


                                                <div id="imagePreviewContainer" style="display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px;"></div>


                                                <script>
                                                    document.getElementById("reviewImages").addEventListener("change", function(event) {
                                                        const previewContainer = document.getElementById("imagePreviewContainer");
                                                        let files = Array.from(event.target.files);


                                                        let currentImages = previewContainer.querySelectorAll(".image-wrapper").length;


                                                        if (currentImages + files.length > 4) {
                                                            alert("You can upload a maximum of 4 images.");
                                                            event.target.value = "";
                                                            return;
                                                        }


                                                        files.forEach(file => {
                                                            const reader = new FileReader();
                                                            reader.onload = function(e) {
                                                                const imageWrapper = document.createElement("div");
                                                                imageWrapper.classList.add("image-wrapper");
                                                                imageWrapper.style.position = "relative";
                                                                imageWrapper.style.display = "inline-block";

                                                                const img = document.createElement("img");
                                                        img.src = e.target.result;
                                                        img.style.width = "100%";
                                                        img.style.height = "100%";
                                                        img.style.objectFit = "cover";

                                                        const deleteBtn = document.createElement("button");
                                                        deleteBtn.innerHTML = "✖";
                                                        deleteBtn.style.position = "absolute";
                                                        deleteBtn.style.top = "2px";
                                                        deleteBtn.style.right = "2px";
                                                        deleteBtn.style.background = "red";
                                                        deleteBtn.style.color = "white";
                                                        deleteBtn.style.border = "none";
                                                        deleteBtn.style.borderRadius = "50%";
                                                        deleteBtn.style.width = "18px";
                                                        deleteBtn.style.height = "18px";
                                                        deleteBtn.style.fontSize = "12px";
                                                        deleteBtn.style.cursor = "pointer";
                                                        deleteBtn.style.display = "flex";
                                                        deleteBtn.style.justifyContent = "center";
                                                        deleteBtn.style.alignItems = "center";
                                                        deleteBtn.style.lineHeight = "1";


                                                        imageWrapper.appendChild(img);
                                                        imageWrapper.appendChild(deleteBtn);


                                                        deleteBtn.addEventListener("click", function() {
                                                            imageWrapper.remove();
                                                        });


                                                        document.getElementById("your-image-container").appendChild(imageWrapper);

                                                                imageWrapper.appendChild(img);
                                                                imageWrapper.appendChild(deleteBtn);
                                                                previewContainer.appendChild(imageWrapper);
                                                            };
                                                            reader.readAsDataURL(file);
                                                        });
                                                    });


                                                </script>


                                                                {{-- <label for="review">Review:</label>
                                                                <input type="text" name="review" id="review" required> --}}


                                                                <label for="comment">Comment:</label>
                                                                <textarea name="review" id="review" rows="4" required></textarea>
                                                                <input type="hidden" name="product_id" id="" value="{{$product->id}}">
                                                                <input type="hidden" name="vendor_id" id="" value="{{$product->vendor_id}}">

                                                                <div class="popup-buttons">
                                                                    <button type="submit" class="submit-btn">Submit</button>
                                                                    <button type="button" id="cancelReviewBtn" class="cancel-btn">Cancel</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>


                                                    <style>

                                                        .popup-overlay {
                                                            display: none;
                                                            position: fixed;
                                                            top: 0;
                                                            left: 0;
                                                            width: 100%;
                                                            height: 100%;
                                                            background: rgba(0, 0, 0, 0.5);
                                                            justify-content: center;
                                                            align-items: center;
                                                            z-index: 2000;
                                                        }


                                                        .popup-content {
                                                            background: white;
                                                            padding: 20px;
                                                            border-radius: 10px;
                                                            width: 400px;
                                                            max-width: 90%;
                                                            text-align: center;
                                                            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
                                                        }


                                                        input, select, textarea {
                                                            width: 100%;
                                                            padding: 8px;
                                                            margin: 10px 0;
                                                            border: 1px solid #ddd;
                                                            border-radius: 5px;
                                                        }


                                                        .popup-buttons {
                                                            display: flex;
                                                            justify-content: space-between;
                                                            margin-top: 15px;
                                                        }

                                                        .submit-btn {
                                                            background-color: rgb(145, 148, 201);
                                                            color: white;
                                                            padding: 10px 15px;
                                                            border: none;
                                                            border-radius: 5px;
                                                            cursor: pointer;
                                                        }

                                                        .cancel-btn {
                                                            background-color: red;
                                                            color: white;
                                                            padding: 10px 15px;
                                                            border: none;
                                                            border-radius: 5px;
                                                            cursor: pointer;
                                                        }


                                                        .popup-content {
                                                            transform: scale(0.8);
                                                            transition: transform 0.3s ease-in-out;
                                                        }

                                                        .popup-overlay.show .popup-content {
                                                            transform: scale(1);
                                                        }
                                                    </style>


                                                    <script>
                                                        document.getElementById("giveReviewBtn").addEventListener("click", function() {
                                                            document.getElementById("reviewPopup").style.display = "flex";
                                                        });

                                                        document.getElementById("cancelReviewBtn").addEventListener("click", function() {
                                                            document.getElementById("reviewPopup").style.display = "none";
                                                        });
                                                    </script>

                                                    <!-- JavaScript for Image Preview -->


                                    {{-- Review Button part --}}

                                                        {{-- <h4>Reviews <span>{{count($reviews)}}</span></h4>
                                                        @foreach ($reviews as $review)
                                                        <div class="main_comment">
                                                            <div class="comment_img">
                                                                <img src="{{asset($review->user->image)}}" alt="user"
                                                                    class="img-fluid w-100">
                                                            </div>
                                                            <div class="comment_text reply">
                                                                <h6>{{$review->user->name}} <span>{{$review->rating}} <i
                                                                            class="fas fa-star"></i></span></h6>
                                                                <span>{{date('d M Y', strtotime($review->created_at))}}</span>
                                                                <p>{{$review->review}}
                                                                </p>
                                                                <ul class="">
                                                                    @if (count($review->productReviewGalleries) > 0)

                                                                    @foreach ($review->productReviewGalleries as $image)

                                                                    <li><img src="{{asset($image->image)}}" alt="product"
                                                                            class="img-fluid "></li>
                                                                    @endforeach
                                                                    @endif

                                                                </ul>
                                                            </div>
                                                        </div>
                                                        @endforeach --}}

                                            {{-- new update 25/02/25 --}}

                                            <h4>Reviews <span>{{ count($reviews) }}</span></h4>

                                            @if(count($reviews) >= 0 && count($reviews) > 0)
                                                @foreach ($reviews as $review)
                                                    <div class="main_comment">
                                                        <div class="comment_img">
                                                            <img src="{{ asset($review->user->image) }}" alt="user" class="img-fluid"
                                                            style="border-radius: 50% !important; height: 80px !important; width: 300px !important; object-fit: cover;">                                                                                                               </div>
                                                        <div class="comment_text reply">
                                                            <h6>
                                                                {{ $review->user->name }}
                                                                <span style="color: #f4c542;">
                                                                    {{ $review->rating }} <i class="fas fa-star"></i>
                                                                </span>
                                                            </h6>
                                                            <span>{{ date('d M Y', strtotime($review->created_at)) }}</span>
                                                            <p>{{ $review->review }}</p>
                                                            <ul class="">
                                                                @if(count($review->productReviewGalleries) >= 0)
                                                                    @foreach ($review->productReviewGalleries as $image)
                                                                        <li>
                                                                            <img src="{{ asset($image->image) }}" alt="product" class="img-fluid">
                                                                        </li>
                                                                    @endforeach
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                {{-- Dummy Review Data when no reviews exist --}}
                                                <div class="main_comment" style="display: flex; align-items: flex-start; gap: 15px; padding: 15px; border-bottom: 1px solid #ddd;">
                                                    <div class="comment_img" style="flex-shrink: 0;">
                                                        <img src="https://static.vecteezy.com/system/resources/previews/000/574/512/original/vector-sign-of-user-icon.jpg" alt="user" class="img-fluid w-100" style="border-radius: 50px;">
                                                    </div>
                                                    <div class="comment_text reply" style="flex-grow: 1;">
                                                        <h6>John Doe
                                                            <span style="color: #f4c542;">5 <i class="fas fa-star"></i></span>
                                                        </h6>
                                                        <span>25 Feb 2025</span>
                                                        <p>This is a great product! I am very satisfied with the quality and the fast delivery.</p>
                                                        <ul style="display: flex; list-style: none; padding: 0; gap: 10px; margin-top: 10px;">
                                                            <li>
                                                                <img src="https://static.vecteezy.com/system/resources/previews/011/883/276/original/modern-graphic-apple-fruit-colorful-logo-good-for-technology-logo-fruits-logo-apple-logo-nutrition-logo-company-logo-dummy-logo-bussiness-logo-vector.jpg" alt="product" class="img-fluid" style="border-radius: 5px;">
                                                            </li>
                                                            <li>
                                                                <img src="https://static.vecteezy.com/system/resources/previews/011/883/276/original/modern-graphic-apple-fruit-colorful-logo-good-for-technology-logo-fruits-logo-apple-logo-nutrition-logo-company-logo-dummy-logo-bussiness-logo-vector.jpg" alt="product" class="img-fluid" style="border-radius: 5px;">
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            @endif


                                                {{-- new update --}}

                                                        <div class="mt-5">
                                                            @if ($reviews->hasPages())
                                                                {{$reviews->links()}}
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-5 mt-4 mt-lg-0">
                                                    @auth
                                                    @php
                                                        $isBrought = false;
                                                        $orders = \App\Models\Order::where(['user_id' => auth()->user()->id, 'order_status' => 'delivered'])->get();
                                                        foreach ($orders as $key => $order) {
                                                           $existItem = $order->orderProducts()->where('product_id', $product->id)->first();

                                                           if($existItem){
                                                            $isBrought = true;
                                                           }
                                                        }

                                                    @endphp

                                                    @if ($isBrought === true)
                                                    <div class="post_comment rev_mar" id="sticky_sidebar3">
                                                        <h4>write a Review</h4>
                                                        <form action="{{route('user.review.create')}}" enctype="multipart/form-data" method="POST">
                                                            @csrf
                                                            <p class="rating">
                                                                <span>select your rating :</span>
                                                            </p>

                                                            <div class="row">

                                                                <div class="col-xl-12 mb-4">
                                                                    <div class="single_com">
                                                                        <select name="rating" id="" class="form-control">
                                                                            <option value="">Select</option>
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                            <option value="4">4</option>
                                                                            <option value="5">5</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <div class="col-xl-12">
                                                                        <div class="single_com">
                                                                            <textarea cols="3" rows="3" name="review"
                                                                                placeholder="Write your review"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="img_upload">
                                                                <div class="">
                                                                    <input type="file" name="images[]" multiple>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="product_id" id="" value="{{$product->id}}">
                                                            <input type="hidden" name="vendor_id" id="" value="{{$product->vendor_id}}">

                                                            <button class="common_btn" type="submit">submit
                                                                review</button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                    @endauth

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--============================
        PRODUCT DETAILS END
    ==============================-->
    <!--============================
        You May Also like start
    ==============================-->
    <section class="arrivels mt-4 mb-4">
        <div class="container">
            <div class="site-title text-center mb-3">
                <h3>You May Also Like</h3>
            </div>
            <div class="homeProductCard customMobileSlide collection_slider">
                {{-- <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4"> --}}
                    @forelse($youMaylike as $product)
                    <div class="col">
                        <div class="products_list_item" >
                            <div class="product_item position-relative">
                                <span class="new badge bg-primary position-absolute"
                                      style="top: 10px; left: 10px;">New</span>

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
                                            <i class="far fa-eye" aria-hidden="true" style="margin-top: 5px"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('product-detail', $product->slug)}}" class="add_to_wishlist" data-id="{{ $product->id }}">
                                            <i class="far fa-heart" aria-hidden="true" style="margin-top: 5px"></i>
                                        </a>
                                    </li>
                                </ul>

                                <div class="product_details text-center mt-3">
                                    <a href="{{route('product-detail', $product->slug)}}" class="pro_name" title="{{ $product->name }}">
                                        {{ $product->name }}
                                    </a>
                                    <p class="price mt-1">₹{{ number_format($product->price, 2) }}</p>

                                    {{-- <form class="shopping-cart-form d-none">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="qty" value="1" min="1" max="100">
                                        <button class="add_cart btn btn-primary mt-2" type="submit">Add to Cart</button>
                                    </form> --}}
                                    <form class="shopping-cart-form-123" method="POST" action="">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="qty" value="1">
                                        <button class="add_cart_button" type="submit">
                                            Add To Cart <i class="fa fa-shopping-cart"></i>
                                        </button>
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
                {{-- </div> --}}
            </div>
        </div>
    </section>
    <!--============================
         You May Also like END
    ==============================-->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" class="message_modal">
            @csrf
            <div class="form-group">
                <label for="">Message</label>
                <textarea name="message" class="form-control mt-2 message-box"></textarea>
                <input type="hidden" name="receiver_id" value="{{ $product->vendor->user_id }}">
              </div>

              <button type="submit" class="btn add_cart mt-4 send-button">Send</button>

          </form>

        </div>

      </div>
    </div>
  </div>
@endsection
<style>

.product-info {
    padding: 20px 20px 20px 0px;
}

.know-product-btn, .tracing-product-btn {
  background-color: gray;
  color: white;
  border: none;
  padding: 12px 24px;
  margin:7px 5px;
  font-size: 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.know-product-btn:hover, .tracing-product-btn:hover {
  background-color: green;
}
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
  padding-top: 60px;
}

.modal-content {
  background-color: #fff;
  margin: 5% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
  max-width: 400px;
  border-radius: 5px;
}

.close-btn {
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
  position: absolute;
  top: 10px;
  right: 25px;
  cursor: pointer;
}

.close-btn:hover,
.close-btn:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

/* Style for Input Fields */
input {
  padding: 10px;
  font-size: 16px;
  width: 100%;
  margin-bottom: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

button {
  padding: 12px 24px;
  background-color: green;
  color: white;
  border: none;
  cursor: pointer;
  font-size: 16px;
  border-radius: 5px;
}

button:disabled {
  background-color: grey;
  cursor: not-allowed;
}


</style>


@push('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                animated: 'fade',
                placement: 'top',
                html: true,
                trigger:"hover"
            });
        });
        $(document).ready(function(){
            $('.message_modal').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    method: 'POST',
                    url: '{{ route("user.send-message") }}',
                    data: formData,
                    beforeSend: function() {
                        let html = `<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Sending..`

                        $('.send-button').html(html);
                        $('.send-button').prop('disabled', true);


                    },
                    success: function(response) {
                        $('.message-box').val('');
                        $('.modal-body').append(`<div class="alert alert-success mt-2"><a href="{{ route('user.messages.index') }}" class="text-primary">Click here</a> for go to messenger.</div>`)
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                       toastr.error(xhr.responseJSON.message);
                       $('.send-button').html('Send');
                       $('.send-button').prop('disabled', false);
                    },
                    complete: function() {
                        $('.send-button').html('Send');
                        $('.send-button').prop('disabled', false);
                    }
                })
            })
        });
        function ShowMe(Id,price){
            $("#inside_handwriting_value_div").hide();
            $("#inside_date_value_div").hide();
            $("#inside_text_value_div").hide();
            $("#inside_text_value").prop("required",false);
            $("#inside_date_value").prop("required",false);
            $("#inside_hand_writing_value").prop("required",false);
            if(Id=="id_text"){
                $("#inside_text_value_div").show();
                $("#inside_text_value").prop("required",true);
            }
            if(Id=="id_date"){
                $("#inside_date_value_div").show();
                $("#inside_date_value").prop("required",true);
            }
            if(Id=="id_handwriting"){
                $("#inside_handwriting_value_div").show();
                $("#inside_hand_writing_value").prop("required",true);
            }
            if(Id=="id_none"){
                price_components["inside_text"] = 0;
            }else{
                price_components["inside_text"] = price;

            }
            addSubtractPrice();
        }

        function showDiv(caller,displayIds,requiredIds,price){
            if($("#"+caller).prop("checked")){
                price_components[caller] = price;
                displayIds.forEach(element => {
                    $("#"+element).show();
                });

                requiredIds.forEach(element => {
                    $("#"+element).prop("required",true);
                });

            }else{
                price_components[caller] = 0;
                displayIds.forEach(element => {
                    $("#"+element).hide();
                });

                requiredIds.forEach(element => {
                    $("#"+element).prop("required",false);
                });
            }
            addSubtractPrice();
        }
        let price_components = [];
        price_components["price"] = 0;
        price_components["offer_price"] = 0;
        price_components["del_price"] = 0;
        price_components["inside_text"] = 0;
        price_components["custom_design_switch"] = 0;
        price_components["gift_wrap_option_switch"] = 0;
        price_components["rush_service_option_switch"] = 0;
        function addSubtractPrice(){
            let price = 0;
            let offer_price = 0;
            let del_price = parseInt($("#del_price").text());

            if(!price_components["price"]){
                price_components["price"] = parseInt($("#price").text());
                price = parseInt($("#price").text());
                price_components["offer_price"] = parseInt($("#offer_price").text());
                price_components["del_price"] = parseInt($("#del_price").text());
            }else{
                price = parseInt(price_components["price"]);
                offer_price = parseInt(price_components["offer_price"]);
                del_price = parseInt(price_components["del_price"]);
            }


            let added_price = 0;
            added_price += parseInt(price_components.inside_text);
            added_price += parseInt(price_components.custom_design_switch);
            added_price += parseInt(price_components.gift_wrap_option_switch);
            added_price += parseInt(price_components.rush_service_option_switch);
            $("#price").text(price+added_price);
            $("#offer_price").text(offer_price+added_price);
            $("#del_price").text(del_price+added_price);
        }


        document.addEventListener("DOMContentLoaded", function() {
    const openModalBtn = document.getElementById("openModalBtn");
    const modal = document.getElementById("productModal");
    const closeModalBtn1 = document.getElementById("closeModalBtn1");
    const form = document.getElementById("productForm");
    const downloadBtn = document.getElementById("downloadBtn");
    const nameInput = document.getElementById("name");
    const phoneInput = document.getElementById("phone");

    var certificateUrl = "{{ $certificateUrl }}";

    openModalBtn.addEventListener("click", function() {
        modal.style.display = "block";
    });

    closeModalBtn1.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    form.addEventListener("input", function() {
        if (nameInput.value.trim() !== "" && phoneInput.value.trim() !== "") {
            downloadBtn.disabled = false;
        } else {
            downloadBtn.disabled = true;
        }
    });

    form.addEventListener("submit", function(e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch("{{ route('storeDownload') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            }
        })
        .then(response => response.json())
        .then(data => {
            downloadCertificate(certificateUrl);
        })
        .catch(error => {
            console.error("An error occurred while saving the data.", error);
        });
    });

    function downloadCertificate(certificateUrl) {
        const link = document.createElement('a');
        link.href = certificateUrl;
        link.download = certificateUrl.split('/').pop();
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }


});


const productLocation = { lat: 30.946820, lng: 75.842359 };
    const warehouseLocation = { lat: 28.592, lng: 77.042 };

    let map;

     function initMap() {
       // Create the map
       map = L.map('map', {
         center: [(productLocation.lat + warehouseLocation.lat) / 2, (productLocation.lng + warehouseLocation.lng) / 2],
         zoom: 12,
         pitch: 30
       });

       L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
       }).addTo(map);

       const productIcon = L.icon({
         iconUrl: 'https://img.icons8.com/ios/50/000000/plant.png',
         iconSize: [32, 32],
         iconAnchor: [16, 32],
         popupAnchor: [0, -32],
       });

   const warehouseIcon = L.icon({
     iconUrl: 'https://img.icons8.com/ios/50/000000/warehouse.png',
     iconSize: [32, 32],
     iconAnchor: [16, 32],
     popupAnchor: [0, -32],
   });

       L.marker([productLocation.lat, productLocation.lng], { icon: productIcon })
         .addTo(map)
         .bindPopup('Product Location: Agricultural Land')
         .openPopup();

   L.marker([warehouseLocation.lat, warehouseLocation.lng], { icon: warehouseIcon })
     .addTo(map)
     .bindPopup('Warehouse Location: Vyaparkranti, Najafgarh')
     .openPopup();

   const routeCoordinates = [
     [productLocation.lat, productLocation.lng],
     [warehouseLocation.lat, warehouseLocation.lng]
   ];

       const polylineOptions = {
         color: 'blue',
         weight: 4,
         opacity: 0.7,
         dashArray: '10, 10',
       };

       const polyline = L.polyline(routeCoordinates, polylineOptions).addTo(map);

       let counter = 0;
       const routeInterval = setInterval(() => {
         if (counter < routeCoordinates.length) {
           polyline.addLatLng(routeCoordinates[counter]);
           counter++;
         } else {
           clearInterval(routeInterval);
         }
       }, 500);

       map.fitBounds(polyline.getBounds());
     }



    document.getElementById('tracingProductBtn').addEventListener('click', function () {
      document.getElementById('tracingModal').style.display = 'block';
      initMap();
    });

    document.getElementById('closeModalBtn').addEventListener('click', function () {
      document.getElementById('tracingModal').style.display = 'none';
    });
    </script>

<script>
    document.querySelectorAll('.add_to_wishlist').forEach(function(element) {
    element.addEventListener('click', function() {
        const icon = this.querySelector('i');
        if (icon.classList.contains('added')) {
            icon.style.color = ''; // Reset color (remove red)
            icon.classList.remove('added');
        } else {
            icon.style.color = 'red'; // Turn red when added
            icon.classList.add('added');
        }
    });
});


</script>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

@endpush



<style>

    .shopping-cart-form {
        width: 100%;


        justify-content: center;
        margin-top: 12px;
    }
    .shopping-cart-form-123 {
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
        padding: 12px 10px;
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


<style>



/* Full-screen overlay for background */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center; /* Horizontal centering */
    align-items: center; /* Vertical centering */
    background-color: rgba(0, 0, 0, 0.5); /* Optional dark overlay */
    z-index: 9999;
}

/* Modal content - centered box */
.modal-content {
    position: relative;
    background-color: #fff;
    padding: 20px;
    width: 90%;
    max-width: 600px;
    max-height: 70vh;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    overflow-y: auto;
}

/* Close button for the modal */
.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 24px;
    cursor: pointer;
    color: #555;
}

/* Responsive map height */
#map {
    width: 100%;
    height: 300px;
}

/* Responsive adjustments for smaller screens */
@media (max-width: 768px) {

.product_item {
    width: 170px !important;
    height: 400px !important;
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
    .modal-content {
        width: 95%;
        padding: 15px;
    }

    #map {
        height: 250px;
    }
}

@media (max-width: 480px) {



.product_item {
    width: 165px !important ;
    height: 400px !important;
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
    .modal-content {
        width: 98%;
        padding: 10px;
    }

    #map {
        height: 200px;
    }

    .close-btn {
        font-size: 20px;
    }
}

</style>



