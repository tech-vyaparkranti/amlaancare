@extends('frontend.layouts.master')

@section('title')
{{$settings->site_name??""}} || Cancellation Policy
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="javascript:;">cancellation policy</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PAYMENT PAGE START
    ==============================-->
    {{-- <section id="cart_view">
        <div class="container">
            <div class="pay_info_area">
                <div class="row">
                    <div class="card">
                        <div class="cart-body p-5">
                            {!!@$terms->content!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section id="cart_view">
        <div class="container">
            <div class="pay_info_area">
                <div class="row">
                    <div class="card">
                        <div class="cart-body p-5">
                            @if(isset($cancel) && !empty($cancel->content))
                                {!! $cancel->content !!}
                            @else
                                <p>Cancellation Policy are not available at the moment. Please check back later.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--============================
        PAYMENT PAGE END
    ==============================-->
@endsection
