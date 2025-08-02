@extends('frontend.layouts.master2')

@section('title')
{{$settings->site_name??""}} || About
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{route('home')}}">home</a></li>
                <li><a href="javascript:;">About</a></li>
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
            
        </div>
    </section> --}}
    <section id="cart_view">
        <div class="container">
            <div class="pay_info_area">
                <div class="row">
                    <div class="card">
                        <div class="cart-body p-5">
                            @if(isset($about) && !empty($about->content))
                                {!! $about->content !!}
                            @else
                                <p>About us are not available at the moment. Please check back later.</p>
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
