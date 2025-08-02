@extends('frontend.layouts.master3')

{{-- @section('title')
    {{$settings->site_name ?? ""}} || Payment
@endsection --}}

@section('title', 'cliquehop.com')


@section('content')
    <!--============================ BREADCRUMB START ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="javascript:;">payment</a></li>
            </ul>
        </div>
    </div>
    <!--============================ BREADCRUMB END ==============================-->


    <!--============================ PAYMENT PAGE START ==============================-->
    <section id="cart_view">
        <div class="container">
            <div class="pay_info_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-3">
                        <div class="payment_menu" id="sticky_sidebar">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                @if(!empty($paypal_settings))
                                    <div class="payment_area">
                                        <a class="nav-link common_btn text-center" href="{{route('user.paypal.payment')}}">Pay
                                            with Paypal</a>
                                    </div>
                                @endif

                                @if (!empty($razorpay_settings))
                                    @include('frontend.pages.payment-gateway.integrations.razorpay')
                                @endif
                                @if (!empty($stripe_settings))
                                    <button class="nav-link common_btn" id="v-pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-stripe" type="button" role="tab" aria-controls="v-pills-stripe"
                                        aria-selected="false">Stripe</button>
                                @endif

                                @if (!empty($cashFree))
                                    <button class="nav-link common_btn" onclick="window.location.href='{{ route('user.cashfree.startPayment') }}'; return false;">CashFree</button>
                                @endif
                                @if (!empty($cod_settings))
                                <button class="nav-link common_btn" onclick="window.location.href='{{ route('user.cod.payment') }}'; return false;">COD</button>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">


                            <div class="tab-pane fade" id="v-pills-paypal" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="row">
                                    <div class="col-xl-12 m-auto">
                                        <div class="payment_area">
                                            <a class="nav-link common_btn text-center"
                                                href="{{route('user.paypal.payment')}}">Pay with Paypal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @include('frontend.pages.payment-gateway.stripe')

                            <!-- @include('frontend.pages.payment-gateway.razorpay') -->

                            <!-- @include('frontend.pages.payment-gateway.cod') -->

                            <!-- @include('frontend.pages.payment-gateway.cashfree') -->



                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4">
                        <div class="pay_booking_summary" id="sticky_sidebar2">
                            <h5>Order Summary</h5>
                            <p>subtotal : <span>{{$settings->currency_icon ?? ''}}{{getCartTotal()}}</span></p>
                            <p>shipping fee(+) : <span>{{$settings->currency_icon ?? ''}}{{getShppingFee()}}</span></p>
                            <p>coupon(-) : <span>{{$settings->currency_icon ?? ''}}{{getCartDiscount()}}</span></p>
                            <h6>total <span>{{$settings->currency_icon ?? ''}}{{getFinalPayableAmount()}}</span></h6>
                        </div>
                    </div>
                </div>
            <!-- <div class="row">
                    <div class="row row-cols-2 g-3">
                        <div class="col">
                            <div class="payment_menu" id="sticky_sidebar">
                                <div class="flex-column">
                                    @if (!empty($paypal_settings))
                                        <p>paypal_settings</p>
                                        <div class="payment_area">
                                            <a class="common_btn text-center" href="{{ route('user.paypal.payment') }}">
                                                Pay with Paypal
                                            </a>
                                        </div>
                                    @endif

                                    @if (!empty($razorpay_settings))
                                        <p>razorpay_settings</p>
                                        @include('frontend.pages.payment-gateway.integrations.razorpay')
                                    @endif

                                    @if (!empty($stripe_settings))
                                        <p>stripe_settings</p>
                                        @include('frontend.pages.payment-gateway.integrations.stripe')
                                    @endif

                                    @if (!empty($cashFree))
                                        <p>cashFree</p>
                                        @include('frontend.pages.payment-gateway.cashfree')
                                    @endif

                                    @if (!empty($cod_settings))
                                        <p>cod_settings</p>
                                        @include('frontend.pages.payment-gateway.cod')
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="pay_booking_summary" id="sticky_sidebar2">
                                <h5>Order Summary</h5>
                                <p>subtotal : <span>{{ $settings->currency_icon ?? '' }}{{ getCartTotal() }}</span></p>
                                <p>shipping fee(+) : <span>{{ $settings->currency_icon ?? '' }}{{ getShppingFee() }}</span>
                                </p>
                                <p>coupon(-) : <span>{{ $settings->currency_icon ?? '' }}{{ getCartDiscount() }}</span></p>
                                <h6>total <span>{{ $settings->currency_icon ?? '' }}{{ getFinalPayableAmount() }}</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>
        </div>
    </section>
    <!--============================ PAYMENT PAGE END ==============================-->
@endsection