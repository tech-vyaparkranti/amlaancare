{{-- @extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name??""}} || Cart Details
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('shop') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">product</a></li>
                <li><a href="#">cart view</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CART VIEW PAGE START
    ==============================-->
    <section id="cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 mb-3">
                    <div class="cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="pro_img">
                                            product item
                                        </th>

                                        <th class="pro_name">
                                            product details
                                        </th>

                                        <th class="pro_tk">
                                           unit price
                                        </th>

                                        <th class="pro_tk">
                                            total
                                        </th>

                                        <th class="pro_select">
                                            quantity
                                        </th>



                                        <th class="pro_icon">
                                            <a href="#" class="common_btn clear_cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach ($cartItems as $item)
                                    <tr class="d-flex">
                                        <td class="pro_img pt-2 pb-2"><img src="{{asset($item->options->image)}}" alt="product"
                                                class="img-fluid w-100">
                                        </td>

                                        <td class="pro_name">
                                            <p>{!! $item->name !!}</p>
                                            @foreach ($item->options->variants as $key => $variant)
                                                <span>{{$key}}: {{$variant['name']}} ({{$settings->currency_icon.$variant['price']}})</span>
                                            @endforeach

                                        </td>

                                        <td class="pro_tk">
                                            <h6>{{$settings->currency_icon.$item->price}}</h6>
                                        </td>

                                        <td class="pro_tk">
                                            <h6 id="{{$item->rowId}}">{{$settings->currency_icon.($item->price + $item->options->variants_total) * $item->qty}}</h6>
                                        </td>

                                        <td class="pro_select">
                                            <div class="product_qty_wrapper">
                                                <button class="btn btn-danger product-decrement" data-minqty="{{ $item->minQty }}"
                                                    {{ $item->qty <= $item->minQty ? 'disabled' : '' }}>-</button>
                                                <input class="product-qty text-center" data-rowid="{{$item->rowId}}" type="text" min="1" max="100" value="{{$item->qty}}" readonly />
                                                <button class="btn btn-success product-increment">+</button>
                                            </div>
                                        </td>

                                        <td class="pro_icon">
                                            <a href="{{route('cart.remove-product', $item->rowId)}}"><i class="far fa-times"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @if (count($cartItems) === 0)
                                        <tr class="d-flex" >
                                            <td class="pro_icon" rowspan="2" style="width:100%">
                                                Cart is empty!
                                            </td>
                                        </tr>

                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <div class="banner-container" style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px;">
                    <!-- First Banner (Half width) -->
                    @if(isset($cartpage_banner_section->banner_one) && isset($cartpage_banner_section->banner_one->banner_image) && isset($cartpage_banner_section->banner_one->banner_url))
                        <a href="{{ $cartpage_banner_section->banner_one->banner_url }}" target="_blank"
                           style="display: block; width: 28%; height: 380px; background-image: url('{{ asset($cartpage_banner_section->banner_one->banner_image) }}'); background-size: cover; background-position: center;">
                            <!-- Optional: You can add any text or additional information on top of the banner if needed -->
                        </a>
                    @endif

                    <div class="col-xl-4 cart-item-details">
                        <div class="cart_list_footer_button" id="sticky_sidebar">
                            <h6>total cart</h6>
                            <p>subtotal: <span id="sub_total">{{$settings->currency_icon ?? ''}}{{getCartTotal()}}</span></p>
                            <p>coupon(-): <span id="discount">{{$settings->currency_icon ?? ''}}{{getCartDiscount()}}</span></p>
                            <p class="total"><span>total:</span> <span id="cart_total">{{$settings->currency_icon ?? ''}}{{getMainCartTotal()}}</span></p>

                            <form id="coupon_form">
                                <input type="text" placeholder="Coupon Code" name="coupon_code" value="{{session()->has('coupon') ? session()->get('coupon')['coupon_code'] : ''}}">
                                <button type="submit" class="common_btn">apply</button>
                            </form>
                            <a class="common_btn mt-4 w-100 text-center" href="{{route('user.checkout')}}">checkout</a>
                            <a class="common_btn mt-1 w-100 text-center" href="{{route('products.index')}}"><i
                                    class="fab fa-shopify"></i> Keep Shopping</a>
                        </div>
                    </div>
                    <!-- Second  Banners -->
                    <div style="display: flex; flex-direction: column; width: 28%; gap: 20px;">
                        <!-- Second Banner -->
                        @if(isset($cartpage_banner_section->banner_two) && isset($cartpage_banner_section->banner_two->banner_image) && isset($cartpage_banner_section->banner_two->banner_url))
                            <a href="{{ $cartpage_banner_section->banner_two->banner_url }}" target="_blank"
                               style="display: block; height: 380px; background-image: url('{{ asset($cartpage_banner_section->banner_two->banner_image) }}'); background-size: cover; background-position: center;">
                            </a>
                        @endif

                    </div>
                </div>


            </div>
        </div>
    </section>

    <!--============================
          CART VIEW PAGE END
    ==============================-->
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // incriment product quantity
        $('.product-increment').on('click', function(){
            let input = $(this).siblings('.product-qty');
            let quantity = parseInt(input.val()) + 1;
            let rowId = input.data('rowid');
            input.val(quantity);

            $.ajax({
                url: "{{route('cart.update-quantity')}}",
                method: 'POST',
                data: {
                    rowId: rowId,
                    quantity: quantity
                },
                success: function(data){
                    if(data.status === 'success'){
                        let productId = '#'+rowId;
                        let totalAmount = "{{$settings->currency_icon ?? ''}}"+data.product_total
                        $(productId).text(totalAmount)

                        renderCartSubTotal()
                        calculateCouponDescount()

                        toastr.success(data.message)
                        checkMinQuantity(input, data.minQty, data.cart_qty);
                    }else if (data.status === 'error'){
                        toastr.error(data.message)
                    }
                },
                error: function(data){

                }
            })
        })

        // decrement product quantity
        $('.product-decrement').on('click', function(){
            let input = $(this).siblings('.product-qty');
            let quantity = parseInt(input.val()) - 1;
            let rowId = input.data('rowid');

            if(quantity < 1){
                quantity = 1;
            }

            input.val(quantity);

            $.ajax({
                url: "{{route('cart.update-quantity')}}",
                method: 'POST',
                data: {
                    rowId: rowId,
                    quantity: quantity
                },
                success: function(data){
                    if(data.status === 'success'){
                        let productId = '#'+rowId;
                        let totalAmount = "{{$settings->currency_icon ?? ''}}"+data.product_total
                        $(productId).text(totalAmount)

                        renderCartSubTotal()
                        calculateCouponDescount()

                        toastr.success(data.message)
                        checkMinQuantity(input, data.minQty, data.cart_qty);
                    }else if (data.status === 'error'){
                        toastr.error(data.message)
                    }
                },
                error: function(data){

                }
            })

        })

        // clear cart
        $('.clear_cart').on('click', function(e){
            e.preventDefault();
            Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will clear your cart!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                    }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'get',
                            url: "{{route('clear.cart')}}",
                            success: function(data){
                                if(data.status === 'success'){
                                    window.location.reload();
                                }
                            },
                            error: function(xhr, status, error){
                                console.log(error);
                            }
                        })
                    }
                })
        })

        // get subtotal of cart and put it on dom
        function renderCartSubTotal(){
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    $('#sub_total').text("{{$settings->currency_icon ?? ''}}"+data);
                },
                error: function(data) {
                    console.log(data);
                }
            })
        }

        // applay coupon on cart

        $('#coupon_form').on('submit', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'GET',
                url: "{{ route('apply-coupon') }}",
                data: formData,
                success: function(data) {
                   if(data.status === 'error'){
                    toastr.error(data.message)
                   }else if (data.status === 'success'){
                    calculateCouponDescount()
                    toastr.success(data.message)
                   }
                },
                error: function(data) {
                    console.log(data);
                }
            })

        })

        // calculate discount amount
        function calculateCouponDescount(){
            $.ajax({
                method: 'GET',
                url: "{{ route('coupon-calculation') }}",
                success: function(data) {
                    if(data.status === 'success'){
                        $('#discount').text('{{$settings->currency_icon ?? ''}}'+data.discount);
                        $('#cart_total').text('{{$settings->currency_icon ?? ''}}'+data.cart_total);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            })
        }


    })

    function checkMinQuantity(input, minQty, cartQty) {
        let decrementBtn = input.siblings('.product-decrement');

        if (cartQty <= minQty) {
            decrementBtn.prop('disabled', true); // Disable button if qty equals minQty
        } else {
            decrementBtn.prop('disabled', false); // Enable button otherwise
        }
    }
</script>
@endpush --}}

{{-- new code start 13/06/2025 --}}

@extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name??""}} || Cart Details
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('shop') }}">Home</a></li>
                <li><a href="{{ route('products.index') }}">product</a></li>
                <li><a href="#">cart view</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->

    <style>
        .modern-cart-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .cart-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .cart-header h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 0;
        }

        .cart-main {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        .cart-items-section {
            flex: 2;
        }

        .cart-summary-section {
            flex: 1;
            position: sticky;
            top: 20px;
        }

        .progress-steps {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            gap: 20px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
        }

        .step.active .step-number {
            background-color: #22c55e;
            color: white;
        }

        .step:not(.active) .step-number {
            background-color: #e5e7eb;
            color: #6b7280;
        }

        .step-text {
            font-size: 14px;
            font-weight: 500;
        }

        .step.active .step-text {
            color: #333;
        }

        .step:not(.active) .step-text {
            color: #6b7280;
        }

        .scheduled-basket {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .basket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .basket-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .basket-total {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .cart-item {
            display: flex;
            gap: 15px;
            padding: 20px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .cart-item:last-child {
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            background: #f3f4f6;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-size: 16px;
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
            line-height: 1.4;
        }

        .item-price {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .original-price {
            text-decoration: line-through;
            color: #6b7280;
            font-size: 14px;
            margin-left: 8px;
        }

        .savings {
            color: #22c55e;
            font-size: 14px;
            font-weight: 500;
        }

        .item-meta {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .item-variants {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 10px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: 1px solid #d1d5db;
            background: white;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 16px;
            color: #374151;
            transition: all 0.2s;
        }

        .qty-btn:hover:not(:disabled) {
            background: #f3f4f6;
            border-color: #9ca3af;
        }

        .qty-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .qty-input {
            width: 50px;
            height: 32px;
            text-align: center;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-weight: 500;
        }

        .remove-item {
            color: #ef4444;
            text-decoration: none;
            font-size: 18px;
            padding: 8px;
            border-radius: 6px;
            transition: background-color 0.2s;
        }

        .remove-item:hover {
            background: #fee2e2;
            color: #dc2626;
        }

        .coupon-section {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .coupon-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .coupon-icon {
            width: 24px;
            height: 24px;
            background: #22c55e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
        }

        .coupon-title {
            font-weight: 600;
            color: #333;
        }

        .coupon-subtitle {
            color: #6b7280;
            font-size: 14px;
        }

        .coupon-form {
            display: flex;
            gap: 10px;
        }

        .coupon-input {
            flex: 1;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
        }

        .coupon-btn {
            background: rgb(var(--color-green));
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .coupon-btn:hover {
            background: #55b6d1;
            color: #333;
        }

        .sign-in-prompt {
            text-align: center;
            margin-bottom: 20px;
        }

        .sign-in-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .sign-in-link:hover {
            text-decoration: underline;
        }

        .payment-summary {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
        }

        .summary-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .summary-row.total {
            border-top: 1px solid #e5e7eb;
            padding-top: 12px;
            margin-top: 16px;
            font-size: 16px;
            font-weight: 600;
        }

        .savings-text {
            color: #22c55e;
            font-weight: 500;
            text-align: right;
            margin-top: 8px;
            font-size: 14px;
        }

        .checkout-btn {
            width: 100%;
            background: rgb(var(--color-green));
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.2s;
        }

        .checkout-btn:hover {
            background: #55b6d1;
            color: #333;
        }

        .continue-shopping {
            width: 100%;
            background: transparent;
            color: #3b82f6;
            border: 1px solid #3b82f6;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 12px;
            transition: all 0.2s;
            text-decoration: none;
            display: block;
            text-align: center;
        }

        .continue-shopping:hover {
            background: #f0f9ff;
        }

        .clear-cart-btn {
            background: #ef4444;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .clear-cart-btn:hover {
            background: #dc2626;
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-cart h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #374151;
        }

        @media (max-width: 768px) {
            .cart-main {
                flex-direction: column;
                gap: 20px;
            }

            .progress-steps {
                flex-wrap: wrap;
                gap: 10px;
            }

            .cart-item {
                flex-direction: column;
                gap: 10px;
            }

            .item-image {
                width: 60px;
                height: 60px;
            }
        }
    </style>

    <!--============================
        MODERN CART VIEW START
    ==============================-->
    <div class="modern-cart-container">
        <div class="cart-header">
            <h1>My Cart</h1>
        </div>

        <div class="progress-steps">
            <div class="step active">
                <div class="step-number">1</div>
                <div class="step-text">Your Cart</div>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <div class="step-text">Order Review</div>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-text">Payment</div>
            </div>
        </div>

        @if (count($cartItems) > 0)
        <div class="cart-main">
            <div class="cart-items-section">
                <div class="scheduled-basket">
                    <div class="basket-header">
                        <div class="basket-title">Scheduled Basket ({{ count($cartItems) }})</div>
                        <div class="basket-total">{{$settings->currency_icon ?? ''}}{{getMainCartTotal()}}</div>
                        <button class="clear-cart-btn clear_cart">Clear Cart</button>
                    </div>

                    @foreach ($cartItems as $item)
                    <div class="cart-item">
                        <img src="{{asset($item->options->image)}}" alt="product" class="item-image">

                        <div class="item-details">
                            <div class="item-name">{!! $item->name !!}</div>

                            <div class="item-price">
                                {{$settings->currency_icon}}{{$item->price}}
                                @if($item->options->variants_total > 0)
                                    <span class="original-price">{{$settings->currency_icon}}{{$item->price + $item->options->variants_total}}</span>
                                @endif
                            </div>

                            @if($item->options->variants_total > 0)
                                <div class="savings">You Save {{$settings->currency_icon}}{{$item->options->variants_total}}</div>
                            @endif

                            @foreach ($item->options->variants as $key => $variant)
                                <div class="item-variants">{{$key}}: {{$variant['name']}} (+{{$settings->currency_icon.$variant['price']}})</div>
                            @endforeach

                            {{-- <div class="item-meta">Sold by: <strong>Your Store</strong></div> --}}
                            {{-- <div class="item-meta">Delivery by 17th Jun</div> --}}

                            <div class="quantity-controls">
                                <button class="qty-btn product-decrement" data-minqty="{{ $item->minQty }}" {{ $item->qty <= $item->minQty ? 'disabled' : '' }}>−</button>
                                <input class="qty-input product-qty text-center" data-rowid="{{$item->rowId}}" type="text" min="1" max="100" value="{{$item->qty}}" readonly />
                                <button class="qty-btn product-increment">+</button>
                            </div>
                        </div>

                        <a href="{{route('cart.remove-product', $item->rowId)}}" class="remove-item">×</a>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="cart-summary-section">
                <div class="coupon-section">
                    <div class="coupon-header">
                        <div class="coupon-icon">%</div>
                        <div>
                            <div class="coupon-title">Apply Coupon</div>
                            <div class="coupon-subtitle">Sign in to see best offers & promotions</div>
                        </div>
                    </div>

                    <form id="coupon_form" class="coupon-form">
                        <input type="text" class="coupon-input" placeholder="Coupon Code" name="coupon_code" value="{{session()->has('coupon') ? session()->get('coupon')['coupon_code'] : ''}}">
                        <button type="submit" class="coupon-btn">Apply</button>
                    </form>
                </div>

                <div class="sign-in-prompt">
                    <a href="/login" class="sign-in-link">Sign in</a>
                </div>

                <div class="payment-summary">
                    <div class="summary-title">Payment Details</div>

                    <div class="summary-row">
                        <span>MRP Total</span>
                        <span id="sub_total">{{$settings->currency_icon ?? ''}}{{getCartTotal()}}</span>
                    </div>

                    <div class="summary-row">
                        <span>Product Discount</span>
                        <span style="color: #22c55e;" id="discount">- {{$settings->currency_icon ?? ''}}{{getCartDiscount()}}</span>
                    </div>

                    <div class="summary-row">
                        <span>Delivery Fee (Scheduled)</span>
                        <span style="color: #22c55e;">FREE</span>
                    </div>

                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="cart_total">{{$settings->currency_icon ?? ''}}{{getMainCartTotal()}}</span>
                    </div>

                    @if(getCartDiscount() > 0)
                    <div class="savings-text">You Saved {{$settings->currency_icon ?? ''}}{{getCartDiscount()}}</div>
                    @endif

                    <a href="{{route('user.checkout')}}" class="checkout-btn">Sign in & Order</a>
                    <a href="{{route('products.index')}}" class="continue-shopping">
                        <i class="fab fa-shopify"></i> Keep Shopping
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="empty-cart">
            <h3>Your cart is empty!</h3>
            <p>Add some products to get started.</p>
            <a href="{{route('products.index')}}" class="checkout-btn" style="max-width: 300px; margin: 20px auto;">
                <i class="fab fa-shopify"></i> Start Shopping
            </a>
        </div>
        @endif

        <!-- Banner Section -->
        @if(isset($cartpage_banner_section))
        <div class="banner-container" style="display: flex; flex-wrap: wrap; gap: 20px; margin-top: 40px;">
            @if(isset($cartpage_banner_section->banner_one) && isset($cartpage_banner_section->banner_one->banner_image) && isset($cartpage_banner_section->banner_one->banner_url))
                <a href="{{ $cartpage_banner_section->banner_one->banner_url }}" target="_blank"
                   style="display: block; flex: 1; min-width: 300px; height: 200px; background-image: url('{{ asset($cartpage_banner_section->banner_one->banner_image) }}'); background-size: cover; background-position: center; border-radius: 12px;">
                </a>
            @endif

            @if(isset($cartpage_banner_section->banner_two) && isset($cartpage_banner_section->banner_two->banner_image) && isset($cartpage_banner_section->banner_two->banner_url))
                <a href="{{ $cartpage_banner_section->banner_two->banner_url }}" target="_blank"
                   style="display: block; flex: 1; min-width: 300px; height: 200px; background-image: url('{{ asset($cartpage_banner_section->banner_two->banner_image) }}'); background-size: cover; background-position: center; border-radius: 12px;">
                </a>
            @endif
        </div>
        @endif
    </div>
    <!--============================
          MODERN CART VIEW END
    ==============================-->
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // increment product quantity
        $('.product-increment').on('click', function(){
            let input = $(this).siblings('.product-qty');
            let quantity = parseInt(input.val()) + 1;
            let rowId = input.data('rowid');
            input.val(quantity);

            $.ajax({
                url: "{{route('cart.update-quantity')}}",
                method: 'POST',
                data: {
                    rowId: rowId,
                    quantity: quantity
                },
                success: function(data){
                    if(data.status === 'success'){
                        let productId = '#'+rowId;
                        let totalAmount = "{{$settings->currency_icon ?? ''}}"+data.product_total
                        $(productId).text(totalAmount)

                        renderCartSubTotal()
                        calculateCouponDescount()

                        toastr.success(data.message)
                        checkMinQuantity(input, data.minQty, data.cart_qty);
                    }else if (data.status === 'error'){
                        toastr.error(data.message)
                    }
                },
                error: function(data){

                }
            })
        })

        // decrement product quantity
        $('.product-decrement').on('click', function(){
            let input = $(this).siblings('.product-qty');
            let quantity = parseInt(input.val()) - 1;
            let rowId = input.data('rowid');

            if(quantity < 1){
                quantity = 1;
            }

            input.val(quantity);

            $.ajax({
                url: "{{route('cart.update-quantity')}}",
                method: 'POST',
                data: {
                    rowId: rowId,
                    quantity: quantity
                },
                success: function(data){
                    if(data.status === 'success'){
                        let productId = '#'+rowId;
                        let totalAmount = "{{$settings->currency_icon ?? ''}}"+data.product_total
                        $(productId).text(totalAmount)

                        renderCartSubTotal()
                        calculateCouponDescount()

                        toastr.success(data.message)
                        checkMinQuantity(input, data.minQty, data.cart_qty);
                    }else if (data.status === 'error'){
                        toastr.error(data.message)
                    }
                },
                error: function(data){

                }
            })

        })

        // clear cart
        $('.clear_cart').on('click', function(e){
            e.preventDefault();
            Swal.fire({
                    title: 'Are you sure?',
                    text: "This action will clear your cart!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, clear it!'
                    }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'get',
                            url: "{{route('clear.cart')}}",
                            success: function(data){
                                if(data.status === 'success'){
                                    window.location.reload();
                                }
                            },
                            error: function(xhr, status, error){
                                console.log(error);
                            }
                        })
                    }
                })
        })

        // get subtotal of cart and put it on dom
        function renderCartSubTotal(){
            $.ajax({
                method: 'GET',
                url: "{{ route('cart.sidebar-product-total') }}",
                success: function(data) {
                    $('#sub_total').text("{{$settings->currency_icon ?? ''}}"+data);
                },
                error: function(data) {
                    console.log(data);
                }
            })
        }

        // apply coupon on cart
        $('#coupon_form').on('submit', function(e){
            e.preventDefault();
            let formData = $(this).serialize();
            $.ajax({
                method: 'GET',
                url: "{{ route('apply-coupon') }}",
                data: formData,
                success: function(data) {
                   if(data.status === 'error'){
                    toastr.error(data.message)
                   }else if (data.status === 'success'){
                    calculateCouponDescount()
                    toastr.success(data.message)
                   }
                },
                error: function(data) {
                    console.log(data);
                }
            })

        })

        // calculate discount amount
        function calculateCouponDescount(){
            $.ajax({
                method: 'GET',
                url: "{{ route('coupon-calculation') }}",
                success: function(data) {
                    if(data.status === 'success'){
                        $('#discount').text('- {{$settings->currency_icon ?? ''}}'+data.discount);
                        $('#cart_total').text('{{$settings->currency_icon ?? ''}}'+data.cart_total);

                        // Update basket total
                        $('.basket-total').text('{{$settings->currency_icon ?? ''}}'+data.cart_total);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            })
        }

    })

    function checkMinQuantity(input, minQty, cartQty) {
        let decrementBtn = input.siblings('.product-decrement');

        if (cartQty <= minQty) {
            decrementBtn.prop('disabled', true);
        } else {
            decrementBtn.prop('disabled', false);
        }
    }
</script>
@endpush


{{-- new code end here 13/06/2025 --}}
