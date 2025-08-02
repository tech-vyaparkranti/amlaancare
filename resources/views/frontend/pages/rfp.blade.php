@extends('frontend.layouts.master')

@section('title')
{{$settings->site_name??""}} || Refund & Return Policy
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{route('home')}}">home</a></li>
                <li><a href="javascript:;">Refund & Return Policy</a></li>
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
                <div class="row">
                    <div class="card">
                        <div class="cart-body p-5">
                            <h3>Return & Refunds</h3>
                            <p>What are the conditions for processing of a return/refund request?</p>
                            <ul>
                                <li><p>Return Request must be initiated by the customer within 48 hours of receiving the product.</p></li>
                                <li><p>Following are the conditions where a Return/Exchange Request can be initiated from customer’s end.</p>
                                    <ul>
                                        <li><p>Product Specifications received are different from the Product Specifications mentioned on the Product Page at the time of order.</p></li>
                                        <li><p>Product received is damaged.</p></li>
                                        <li><p>Product received is different from the product which was ordered.</p></li>
                                        <li><p>Once the order is received make sure the product is unopened with the seal, price tag and product intact (making it fit for resale).</p></li>
                                        <li><p>Video of unboxing is mandatory in case of damaged/defective/wrong product received.</p></li>
                                    </ul>
                                </li>
                            </ul>
                            <p>What are the conditions under which a Return Request cannot be processed?</p>
                            <p>Return request cannot be processed for the following conditions:</p>
                            <ul>
                                <li><p>Any damage caused due to normal wear and tear,</p></li>
                                <li><p>Improper usage.</p></li>
                                <li><p>Unauthorised Modifications made to the product</p></li>
                            </ul>
                            <p>Used Product won’t be accepted for a Return Request under any circumstances.</p>
                            <p>What are the steps to be followed for processing a Return/Exchange Request?</p>
                            <ul>
                                <li><p>To initiate the Return/Exchange process, customer must send an email to <a href="mailto:info@exportsans.com">info@exportsans.com</a> mentioning the following details:</p>
                                    <ul>
                                        <li><p>Subject Line: Return Request for Order ID: <b>‘ORDERNUMBER’</b></p></li>
                                        <li><p>Detailed description of the fault in the product, and reason for initiating the exchange/return request.</p></li>
                                    </ul>
                                </li>
                            </ul>
                            <p>For any further guidance or help, reach out to us at <a href="mailto:info@exportsans.com">info@exportsans.com</a>.</p>
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
