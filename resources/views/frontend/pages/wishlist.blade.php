@extends('frontend.layouts.master2')

@section('title')
{{$settings->site_name??""}} || Wishlist
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
                <li><a href="#">wishlist</a></li>
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
                <div class="col-12">
                    <div class="cart_list wishlist">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="pro_img">
                                            product item
                                        </th>

                                        <th class="pro_name" style="width:500px">
                                            product details
                                        </th>

                                        <th class="pro_status">
                                            quantity left
                                        </th>

                                        <th class="pro_tk" style="width:238px" >
                                            price
                                        </th>

                                        <th class="pro_icon">
                                            action
                                        </th>
                                    </tr>
                                    @foreach ($wishlistProducts as $item)

                                    <tr class="d-flex">
                                        <td class="pro_img"><img src="{{asset($item->product->thumb_image)}}" alt="product"
                                                class="img-fluid w-100">
                                            <a href="{{route('user.wishlist.destory', $item->id)}}"><i class="far fa-times"></i></a>
                                        </td>

                                        <td class="pro_name" style="width:500px">
                                            <p>{{$item->product->name}}</p>
                                        </td>

                                        <td class="pro_status">
                                            <p>{{$item->product->qty}}</p>
                                        </td>

                                        <td class="pro_tk" style="width:238px">
                                            <h6>
                                                {{$settings->currency_icon ?? ''}}{{$item->product->offer_price}}
                                            </h6>
                                        </td>

                                        <td class="">
                                            <a class="common_btn" href="{{route('product-detail', $item->product->slug)}}">View Product</a>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
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

@endpush
