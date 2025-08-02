@extends('frontend.layouts.master')

@section('title')
{{$settings->site_name??""}} || Bulk Order
@endsection

@section('content')
       <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">Bulk Order</a></li>
            </ul>
        </div>
    </div>
    <section class="bulk-order">
        <div class="container">
            <div class="bulkorder-container">
                <h5 class="text-center">Bulk Order</h5>
                <h6 class=" mt-3 mb-2">Bulk/Wholesale Enquiry</h6>
                <p class="bulk-para">We are manufacturer of ladies garments. We cater to wholesalers and retailers all across India. We deliver quality and excellent support to our customers. Shop variety of collections at affordable price. Contact us @ + 91 ___________ for bulk enquiry or drop an email us – support@venuses.com</p>
               <h6 class=" mt-3 mb-2">Why Choose us</h6>
               <ul class="bulk-ul ms-3">
                    <li>Eco- Friendly Material</li>
                    <li>Up to Date Fashion</li>
                    <li>Shipping All Across India</li>
                    <li>Return & Exchange Available</li>
                    <li>COD is available with 10% advance</li>
               </ul>
            </div>
        </div>
    </section>
<style>
    .bulk-para{
        text-align: justify;
    }
    .bulk-ul{
        list-style: disc;
    }
</style>
@endsection