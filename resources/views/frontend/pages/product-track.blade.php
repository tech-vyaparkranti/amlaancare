@extends('frontend.layouts.master2')

@section('title')
    {{$settings->site_name ?? ''}} || Order Tracking
@endsection

@section('content')
    <!--============================ BREADCRUMB START ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a>Order Tracking</a></li>
            </ul>
        </div>
    </div>
    <!--============================ BREADCRUMB END ==============================-->

    <!--============================ TRACKING ORDER START ==============================-->
    <section id="login_register" class="pt-5">
        <div class="container">
            <div class="track_area">
                <div class="row">
                    <div class="col-xl-5 col-md-10 col-lg-8 m-auto">
                        <!-- Order Tracking Form -->
                        <form class="tack_form" action="{{ route('product-traking.index') }}" method="GET">
                            <h4 class="text-center">Order Tracking</h4>
                            <p class="text-center">Track your order status</p>
                            <div class="track_input">
                                <label class="d-block mb-2">Order ID*</label>
                                <input type="text" placeholder="SH123456" name="order_id" value="{{ old('order_id') }}">
                            </div>
                            <button type="submit" class="common_btn">Track</button>
                        </form>
                    </div>
                </div>

                <!-- Track Order Details -->
                @if (isset($trackingDetails))
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="track_header">
                                <div class="track_header_text">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="track_header_single">
                                                <h5>Order Date</h5>
                                                <p>{{ date('d M Y', strtotime($trackingDetails['created_at'])) }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="track_header_single">
                                                <h5>Customer Name:</h5>
                                                <p>{{ $trackingDetails['customer_name'] ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="track_header_single">
                                                <h5>Status:</h5>
                                                <p>{{ $orderStatus ?? 'Not Available' }}</p>
                                            </div>
                                        </div>

                                        <!-- Show AWB and Courier if available -->
                                        @if ($awbNumber && $courierName)
                                            <div class="col-xl-3 col-sm-6 col-lg-3">
                                                <div class="track_header_single">
                                                    <h5>Tracking ID:</h5>
                                                    <p>{{ $awbNumber ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-sm-6 col-lg-3">
                                                <div class="track_header_single">
                                                    <h5>Courier:</h5>
                                                    <p>{{ $courierName ?? 'N/A' }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Progress Tracker -->
                        <div class="col-xl-12">
                            <ul class="progtrckr" data-progtrckr-steps="4">
                                <li class="progtrckr_done icon_one check_mark">Pending</li>
                                
                                @if ($orderStatus == 'delivered')
                                    <li class="icon_four check_mark">Delivered</li>
                                @elseif ($orderStatus == 'shipped')
                                    <li class="progtrckr_done icon_two check_mark">Shipped</li>
                                    <li class="icon_three">On the way</li>
                                @else
                                    <li class="progtrckr_done icon_two">Order Processing</li>
                                @endif
                            </ul>
                        </div>

                        <!-- Back Button -->
                        <div class="col-xl-12">
                            <a href="{{ url('/') }}" class="common_btn"><i class="fas fa-chevron-left"></i> Back to Home</a>
                        </div>
                    </div>
                @endif

                <!-- Error Message -->
                @if (isset($errorMessage))
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--============================ TRACKING ORDER END ==============================-->
@endsection
