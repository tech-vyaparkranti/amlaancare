{{-- @extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name??""}} || Payment
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('shop') }}">Home</a></li>
                <li><a href="javascript:;">payment</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="cart_view">
        <div class="container">
            <div class="pay_info_area">
                <div class="row" style="display: flex; justify-content: center; margin-top: 20px;">
                    <div class="success-box-main" id="success-box">
                        <h1><i class="fas "></i> ✅ Payment Success!  {{ $message ?? "" }}</h1>
                    </div>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

                </div>



<style>
        .pay_info_area {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 40vh;
            padding: 20px;
        }

        .success-box-main {
            max-width: 500px;
            min-height: 150px;
            background-color: whitesmoke;
            color: black;
            padding: 20px 30px;
            border: 2px solid black;
            border-radius: 0px;
            box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .success-box-main h1 {
            margin: 0;
            font-size: 22px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .success-box-main i {
            color: #28a745;
            font-size: 28px;
        }


        @media (max-width: 768px) {
            .success-box-main {
                width: 90%;
                padding: 15px 20px;
                font-size: 16px;
            }
            .pay_info_area {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 20vh;
            padding: 20px;
        }

            .success-box-main h1 {
                font-size: 18px;
            }

            .success-box-main i {
                font-size: 24px;
            }
        }
    </style>




            </div>

        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->

    <script>

        function showPaymentFailedPopup(message = "Transaction success processed.") {
            const modal = document.getElementById("payment-failed-modal");
            const messageSpan = document.getElementById("payment-message");

            messageSpan.textContent = message;
            modal.style.display = "block";

            document.querySelector(".close").onclick = function () {
                modal.style.display = "none";
            };

            window.onclick = function (event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            };
        }

        // Call this function when payment fails
        setTimeout(() => {
            showPaymentFailedPopup("Transaction Completed Successfully!");
        }, 1000);

          </script>
@endsection --}}


@extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name??""}} || Payment
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('shop') }}">Home</a></li>
                <li><a href="javascript:;">payment</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->

    <style>
        .payment-success-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .success-header {
            text-align: center;
            margin-bottom: 40px;
            padding: 40px 20px;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            border-radius: 16px;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .success-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .success-title {
            font-size: 32px;
            font-weight: 700;
            margin: 0 0 10px;
            position: relative;
            z-index: 1;
        }

        .success-message {
            font-size: 18px;
            opacity: 0.9;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .order-summary {
            background: white;
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #f1f5f9;
        }

        .summary-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f5f9;
        }

        .order-number {
            font-size: 20px;
            font-weight: 600;
            color: #1e293b;
        }

        .order-date {
            color: #64748b;
            font-size: 14px;
        }

        .order-status {
            background: #dcfce7;
            color: #166534;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .order-items {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-icon {
            width: 20px;
            height: 20px;
            background: #3b82f6;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
        }

        .item-card {
            display: flex;
            gap: 15px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 12px;
            margin-bottom: 12px;
            border: 1px solid #e2e8f0;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            background: #e2e8f0;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
            font-size: 14px;
        }

        .item-variant {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 4px;
        }

        .item-price {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
        }

        .item-quantity {
            color: #64748b;
            font-size: 12px;
        }

        .payment-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 30px;
        }

        .detail-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            border: 1px solid #e2e8f0;
        }

        .detail-title {
            font-size: 16px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .detail-content {
            color: #64748b;
            font-size: 14px;
            line-height: 1.5;
        }

        .price-breakdown {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .price-row.total {
            border-top: 2px solid #e2e8f0;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
        }

        .discount {
            color: #22c55e;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn-primary {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            font-size: 14px;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #3b82f6;
            border: 1px solid #3b82f6;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            font-size: 14px;
        }

        .btn-secondary:hover {
            background: #f0f9ff;
        }

        .delivery-info {
            background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #3b82f6;
        }

        .delivery-title {
            font-weight: 600;
            color: #1e40af;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .delivery-text {
            color: #1e40af;
            font-size: 14px;
        }

        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 10px;
            top: 0;
            height: 100%;
            width: 2px;
            background: #e2e8f0;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -14px;
            top: 5px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
        }

        .timeline-item.active::before {
            background: #3b82f6;
            width: 12px;
            height: 12px;
            left: -16px;
            top: 3px;
        }

        .timeline-title {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
        }

        .timeline-desc {
            color: #64748b;
            font-size: 12px;
            margin-top: 2px;
        }

        @media (max-width: 768px) {
            .payment-success-container {
                padding: 20px 15px;
            }

            .success-title {
                font-size: 24px;
            }

            .success-message {
                font-size: 16px;
            }

            .payment-details {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-primary, .btn-secondary {
                width: 100%;
                justify-content: center;
                max-width: 300px;
            }
        }
    </style>

    <!--============================
        PAYMENT SUCCESS PAGE START
    ==============================-->
    <section id="payment_success">
        <div class="payment-success-container">
            <!-- Success Header -->
            <div class="success-header">
                <div class="success-icon">
                    ✅
                </div>
                <h1 class="success-title">Payment Success!</h1>
                <p class="success-message">{{ $message ?? "Your order has been confirmed and is being processed." }}</p>
            </div>

            <!-- Order Summary -->
            {{-- <div class="order-summary">
                <div class="summary-header">
                    <div>
                        <div class="order-number">Order #{{session('order_id', '123456789')}}</div>
                        <div class="order-date">Placed on {{ date('F j, Y \a\t g:i A') }}</div>
                    </div>
                    <div class="order-status">Confirmed</div>
                </div>

                <!-- Order Items -->
                <div class="order-items">
                    <div class="section-title">
                        <div class="section-icon">📦</div>
                        Order Items
                    </div>

                    @if(session('cart_items'))
                        @foreach(session('cart_items') as $item)
                        <div class="item-card">
                            <img src="{{asset($item['image'] ?? 'default-product.jpg')}}" alt="product" class="item-image">
                            <div class="item-details">
                                <div class="item-name">{{$item['name'] ?? 'Product Name'}}</div>
                                @if(isset($item['variants']))
                                    @foreach($item['variants'] as $key => $variant)
                                        <div class="item-variant">{{$key}}: {{$variant['name']}}</div>
                                    @endforeach
                                @endif
                                <div class="item-price">{{$settings->currency_icon ?? '$'}}{{$item['price'] ?? '0'}}</div>
                                <div class="item-quantity">Qty: {{$item['qty'] ?? '1'}}</div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <!-- Sample items for display -->
                        <div class="item-card">
                            <div class="item-image"></div>
                            <div class="item-details">
                                <div class="item-name">Your Ordered Items</div>
                                <div class="item-variant">Items will be delivered as per schedule</div>
                                <div class="item-price">{{$settings->currency_icon ?? '$'}}{{session('order_total', '349.00')}}</div>
                                <div class="item-quantity">Processing...</div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Price Breakdown -->
                <div class="price-breakdown">
                    <div class="section-title">
                        <div class="section-icon">💳</div>
                        Payment Summary
                    </div>

                    <div class="price-row">
                        <span>Subtotal</span>
                        <span>{{$settings->currency_icon ?? '$'}}{{session('subtotal', '1,497.00')}}</span>
                    </div>
                    <div class="price-row discount">
                        <span>Discount Applied</span>
                        <span>- {{$settings->currency_icon ?? '$'}}{{session('discount', '1,148.00')}}</span>
                    </div>
                    <div class="price-row">
                        <span>Delivery Fee</span>
                        <span class="discount">FREE</span>
                    </div>
                    <div class="price-row total">
                        <span>Total Paid</span>
                        <span>{{$settings->currency_icon ?? '$'}}{{session('order_total', '349.00')}}</span>
                    </div>
                </div>
            </div> --}}

            <!-- Payment & Delivery Details -->


            <!-- Delivery Information -->


            <!-- Order Timeline -->


            <!-- Action Buttons -->

        </div>
    </section>
    <!--============================
        PAYMENT SUCCESS PAGE END
    ==============================-->

    <script>
        // Keep existing functionality
        function showPaymentFailedPopup(message = "Transaction success processed.") {
            // Keep for backward compatibility if needed
            console.log("Payment Success:", message);
        }

        // Auto-scroll animation
        document.addEventListener('DOMContentLoaded', function() {
            const successHeader = document.querySelector('.success-header');
            successHeader.style.opacity = '0';
            successHeader.style.transform = 'translateY(-20px)';

            setTimeout(() => {
                successHeader.style.transition = 'all 0.8s ease';
                successHeader.style.opacity = '1';
                successHeader.style.transform = 'translateY(0)';
            }, 200);

            // Animate order summary
            const orderSummary = document.querySelector('.order-summary');
            setTimeout(() => {
                orderSummary.style.transition = 'all 0.6s ease';
                orderSummary.style.opacity = '1';
                orderSummary.style.transform = 'translateY(0)';
            }, 400);
        });

        // Call existing function for compatibility
        setTimeout(() => {
            showPaymentFailedPopup("Transaction Completed Successfully!");
        }, 1000);
    </script>
@endsection
