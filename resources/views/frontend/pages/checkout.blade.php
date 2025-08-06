@extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name??""}} || Checkout
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="javascript:;">check out</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CHECK OUT PAGE START
    ==============================-->
    <section id="cart_view">
        <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="check_form">
                            <div class="d-flex">
                                <h5>Shipping Details </h5>
                            <a href="javascript:;" style="margin-left:auto;" class="common_btn" data-bs-toggle="modal" data-bs-target="#exampleModal">add
                                new address</a>
                            </div>

                            <div class="row">
                                @foreach ($addresses as $address)
                                <div class="col-xl-6">
                                    <div class="checkout_single_address">
                                        <div class="form-check">
                                            <input class="form-check-input shipping_address" {{ count($addresses)==1?'checked':'' }} data-id="{{$address->id}}" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Select Address
                                            </label>
                                        </div>
                                        <ul>
                                            <li><span>Name :</span> {{$address->name}}</li>
                                            <li><span>Phone :</span> {{$address->phone}}</li>
                                            <li><span>Email :</span> {{$address->email}}</li>
                                            <li><span>Country :</span> {{$address->country}}</li>
                                            <li><span>City :</span> {{$address->city}}</li>
                                            <li><span>Zip Code :</span> {{$address->zip}}</li>
                                            <li><span>Address :</span> {{$address->address}}</li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="order_details" id="sticky_sidebar" style="position: sticky; top: 20px; z-index: 1; padding: 20px 20px 30px 20px; background-color: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                            {{-- <p class="product">shipping Methods</p>
                            @foreach ($shippingMethods as $method)
                                @if ($method->type === 'min_cost' && getCartTotal() >= $method->min_cost)
                                    <div class="form-check">
                                        <input class="form-check-input shipping_method" type="radio" name="exampleRadios" id="exampleRadios1"
                                            value="{{$method->id}}" data-id="{{$method->cost}}">
                                        <label class="form-check-label" for="exampleRadios1">
                                            {{$method->name}}
                                            <span>cost: ({{$settings->currency_icon ?? '₹'}}{{$method->cost}})</span>
                                        </label>
                                    </div>
                                @elseif ($method->type === 'flat_cost')
                                    <div class="form-check">
                                        <input class="form-check-input shipping_method" type="radio" name="exampleRadios" id="exampleRadios1"
                                            value="{{$method->id}}" data-id="{{$method->cost}}">
                                        <label class="form-check-label" for="exampleRadios1">
                                            {{$method->name}}
                                            <span>cost: ({{$settings->currency_icon ?? '₹'}}{{$method->cost}})</span>
                                        </label>
                                    </div>
                                @endif
                            @endforeach --}}

                            <div class="order_details_summery">
                                <p>subtotal: <span>{{$settings->currency_icon ?? '₹'}}{{getCartTotal()}}</span></p>
                                <p>shipping fee(+): <span id="shipping_fee">{{$settings->currency_icon ?? '₹'}}0</span></p>
                                <p>coupon(-): <span>{{$settings->currency_icon ?? ''}}{{getCartDiscount()}}</span></p>
                                <p><b>total:</b> <span><b id="total_amount" data-id="{{getMainCartTotal()}}">{{$settings->currency_icon ?? ''}}{{getMainCartTotal()}}</b></span></p>
                            </div>
                            <div class="terms_area">
                                <div class="form-check">
                                    <input class="form-check-input agree_term" type="checkbox" value="" id="flexCheckChecked3"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked3">
                                        I have read and agree to the website <a href="#">terms and conditions *</a>
                                    </label>
                                </div>
                            </div>
                            <form action="" id="checkOutForm">
                                <input type="hidden" name="shipping_method_id" value="" id="shipping_method_id">
                                <input type="hidden" name="shipping_address_id" value="" id="shipping_address_id">

                            </form>
                            <a href="" id="submitCheckoutForm" class="common_btn">Place Order</a>
                        </div>
                    </div>
                </div>
        </div>
    </section>

    <div class="popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="check_form p-3">
                            <form action="{{route('user.checkout.address.create')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="check_single_form">
                                            <input type="text" placeholder="Name *" name="name" value="{{old('name')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="check_single_form">
                                            <input type="text" placeholder="Phone *" name="phone" value="{{old('phone')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="check_single_form">
                                            <input type="email" placeholder="Email *" name="email" value="{{old('email',(Auth::user()->email??""))}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="check_single_form">
                                            <select class="select_2_modal" name="country"   data-placeholder="Country / Region " >
                                                <option value="">Country / Region *</option>
                                                @foreach (config('settings.country_list') as $key => $county)
                                                    <option {{$county === old('country') ? 'selected' : ''}} value="{{$county}}">{{$county}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="check_single_form">
                                            <input type="text" placeholder="State *" name="state" value="{{old('state')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="check_single_form">
                                            <input type="text" placeholder="Town / City *" name="city" value="{{old('city')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="check_single_form">
                                            <input type="text" placeholder="Zip *" name="zip" value="{{old('zip')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="check_single_form">
                                            <input type="text" placeholder="Address *" name="address" value="{{old('address')}}">
                                        </div>
                                    </div>

                                    <div class="col-xl-12">
                                        <div class="check_single_form">
                                            <button type="submit" class="btn btn-primary common_btn">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============================
        CHECK OUT PAGE END
    ==============================-->
@endsection

@push('scripts')
{{-- <script>
    $('.select_2_modal').select2({
    dropdownParent: $('#exampleModal')
    });
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('input[type="radio"]').prop('checked', false);
        $('#shipping_method_id').val("");
        $('#shipping_address_id').val("");

        $('.shipping_method').on('click', function(){
            let shippingFee = $(this).data('id');
            let currentTotalAmount = $('#total_amount').data('id')
            let totalAmount = currentTotalAmount + shippingFee;

            $('#shipping_method_id').val($(this).val());
            $('#shipping_fee').text("{{$settings->currency_icon ?? '₹'}}"+shippingFee);

            $('#total_amount').text("{{$settings->currency_icon ?? '₹'}}"+totalAmount)
        })

        $('.shipping_address').on('click', function(){
            $('#shipping_address_id').val($(this).data('id'));
        })

        // submit checkout form
        $('#submitCheckoutForm').on('click', function(e){
            e.preventDefault();
            if($('#shipping_method_id').val() == ""){
                toastr.error('Shipping method is requred');
            }else if ($('#shipping_address_id').val() == ""){
                toastr.error('Shipping address is requred');
            }else if (!$('.agree_term').prop('checked')){
                toastr.error('You have to agree website terms and conditions');
            }else {
                $.ajax({
                    url: "{{route('user.checkout.form-submit')}}",
                    method: 'POST',
                    data: $('#checkOutForm').serialize(),
                    beforeSend: function(){
                        $('#submitCheckoutForm').html('<i class="fas fa-spinner fa-spin fa-1x"></i>')
                    },
                    success: function(data){
                        if(data.status === 'success'){
                            $('#submitCheckoutForm').text('Place Order')
                            // redirect user to next page
                            window.location.href = data.redirect_url;
                        }
                    },
                    error: function(data){
                        console.log(data);
                    }
                })
            }



        })
    })
</script> --}}

<script>
    $(document).ready(function() {

        // Function to refresh CSRF token dynamically (fixes 419 error after login)
        function refreshCsrfToken() {
            $.get("{{ route('refresh-csrf') }}", function (data) {
                $('meta[name="csrf-token"]').attr('content', data.token);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': data.token
                    }
                });
            });
        }

        // Refresh the CSRF token immediately after page load
        refreshCsrfToken();

        $('input[type="radio"]').prop('checked', false);
        $('#shipping_address_id').val("");

        $('.shipping_method').on('click', function() {
            let shippingFee = $(this).data('id');
            let currentTotalAmount = $('#total_amount').data('id');
            let totalAmount = currentTotalAmount + shippingFee;

            $('#shipping_fee').text("{{ $settings->currency_icon??'₹' }}" + shippingFee);
            $('#total_amount').text("{{ $settings->currency_icon ?? '₹'}}" + totalAmount);
        });

        $('.shipping_address').on('click', function() {
            $('#shipping_address_id').val($(this).data('id'));
        });

        $('#submitCheckoutForm').on('click', function(e) {
            e.preventDefault();

            if ($('#shipping_address_id').val() === "") {
                toastr.error('Shipping address is required');
            } else if (!$('.agree_term').prop('checked')) {
                toastr.error('You have to agree to the website terms and conditions');
            } else {
                $.ajax({
                    url: "{{ route('user.checkout.form-submit') }}",
                    method: 'POST',
                    data: $('#checkOutForm').serialize(),
                    beforeSend: function() {
                        $('#submitCheckoutForm').html('<i class="fas fa-spinner fa-spin fa-1x"></i>')
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            $('#submitCheckoutForm').text('Place Order');
                            window.location.href = data.redirect_url;
                        }
                    },
                    error: function(data) {
                        console.log(data);
                        toastr.error('Something went wrong. Please try again.');
                    }
                });
            }
        });
    });
</script>

@endpush
