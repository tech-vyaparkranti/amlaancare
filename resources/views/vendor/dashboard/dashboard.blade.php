@extends('vendor.layouts.master')
@section('title')
    {{ $settings->site_name ?? '' }} || Dashboard
@endsection
@section('content')
    <section id="dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row" >
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content">
                        <div class="dashboard">
                            <div class="row">
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="{{ route('vendor.orders.index') }}">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24"><path d="M22.713,4.077A2.993,2.993,0,0,0,20.41,3H4.242L4.2,2.649A3,3,0,0,0,1.222,0H1A1,1,0,0,0,1,2h.222a1,1,0,0,1,.993.883l1.376,11.7A5,5,0,0,0,8.557,19H19a1,1,0,0,0,0-2H8.557a3,3,0,0,1-2.82-2h11.92a5,5,0,0,0,4.921-4.113l.785-4.354A2.994,2.994,0,0,0,22.713,4.077Z"/><circle cx="7" cy="22" r="2"/><circle cx="17" cy="22" r="2"/></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $totalOrder }}</span>
                                            <p>Today's Orders</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="{{ route('vendor.orders.index') }}">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M23.32,4.1c-.57-.7-1.42-1.1-2.32-1.1H7.24l-.04-.35c-.18-1.51-1.46-2.65-2.98-2.65h-1.22c-.55,0-1,.45-1,1s.45,1,1,1h1.22c.51,0,.93,.38,.99,.88l1.38,11.7c.3,2.52,2.43,4.42,4.97,4.42h8.44c.55,0,1-.45,1-1s-.45-1-1-1H11.56c-1.29,0-2.4-.83-2.82-2h9.42c2.38,0,4.44-1.69,4.9-4.02l.88-4.39c.18-.88-.05-1.79-.62-2.49ZM11,22c0,1.1-.9,2-2,2s-2-.9-2-2,.9-2,2-2,2,.9,2,2Zm9,0c0,1.1-.9,2-2,2s-2-.9-2-2,.9-2,2-2,2,.9,2,2ZM0,6c0-.55,.45-1,1-1h1.54c.55,0,1,.45,1,1s-.45,1-1,1H1c-.55,0-1-.45-1-1Zm0,4c0-.55,.45-1,1-1H3c.55,0,1,.45,1,1s-.45,1-1,1H1c-.55,0-1-.45-1-1Zm5,4c0,.55-.45,1-1,1H1c-.55,0-1-.45-1-1s.45-1,1-1h3c.55,0,1,.45,1,1Z" /></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $todaysPendingOrder }}</span>
                                            <p>Td's Pending Orders</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="{{ route('vendor.orders.index') }}">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"><circle cx="7" cy="22" r="2" /><circle cx="17" cy="22" r="2" /><path d="M23,3H21V1a1,1,0,0,0-2,0V3H17a1,1,0,0,0,0,2h2V7a1,1,0,0,0,2,0V5h2a1,1,0,0,0,0-2Z" /><path d="M21.771,9.726a.994.994,0,0,0-1.162.806A3,3,0,0,1,17.657,13H5.418l-.94-8H13a1,1,0,0,0,0-2H4.242L4.2,2.648A3,3,0,0,0,1.222,0H1A1,1,0,0,0,1,2h.222a1,1,0,0,1,.993.883l1.376,11.7A5,5,0,0,0,8.557,19H19a1,1,0,0,0,0-2H8.557a3,3,0,0,1-2.829-2H17.657a5,5,0,0,0,4.921-4.112A1,1,0,0,0,21.771,9.726Z" /></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $totalOrder }}</span>
                                            <p>Total Orders</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="{{ route('vendor.orders.index') }}">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M19,10c2.761,0,5-2.239,5-5S21.761,0,19,0s-5,2.239-5,5,2.239,5,5,5Zm-1-8h2v2.586l1.707,1.707-1.414,1.414-2.293-2.293V2Zm1,20c0,1.105-.895,2-2,2s-2-.895-2-2,.895-2,2-2,2,.895,2,2Zm3.244-10.8l-1.873,6.8H7.405c-1.748,0-3.239-1.306-3.47-3.039L2.398,3.434c-.032-.247-.246-.434-.496-.434H0V0H1.902c1.747,0,3.238,1.306,3.47,3.037l.262,1.963h6.366c0,1.075,.25,2.09,.683,3H6.034l.876,6.566c.032,.248,.245,.434,.495,.434h10.685l.823-3.004c.029,0,.058,.004,.087,.004,1.172,0,2.274-.292,3.244-.8Zm-13.244,10.8c0,1.105-.895,2-2,2s-2-.895-2-2,.895-2,2-2,2,.895,2,2Z"/></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $totalPendingOrder }}</span>
                                            <p>Total Pending Orders</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="{{ route('vendor.orders.index') }}">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Filled" viewBox="0 0 24 24"><path d="M18,12a5.993,5.993,0,0,1-5.191-9H4.242L4.2,2.648A3,3,0,0,0,1.222,0H1A1,1,0,0,0,1,2h.222a1,1,0,0,1,.993.883l1.376,11.7A5,5,0,0,0,8.557,19H19a1,1,0,0,0,0-2H8.557a3,3,0,0,1-2.821-2H17.657a5,5,0,0,0,4.921-4.113l.238-1.319A5.984,5.984,0,0,1,18,12Z" /><circle cx="7" cy="22" r="2" /><circle cx="17" cy="22" r="2" /><path d="M15.733,8.946a1.872,1.872,0,0,0,1.345.6h.033a1.873,1.873,0,0,0,1.335-.553l4.272-4.272A1,1,0,1,0,21.3,3.3L17.113,7.494,15.879,6.17a1,1,0,0,0-1.463,1.366Z" /></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $totalCompleteOrder }}</span>
                                            <p>Completed Orders</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="{{ route('vendor.products.index') }}">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M23.576,6.429l-1.91-3.171L12,.036,2.334,3.258,.442,6.397c-.475,.792-.563,1.742-.243,2.607,.31,.839,.964,1.488,1.8,1.793l-.008,9.844,10,3.333,10-3.333,.008-9.844c.846-.296,1.507-.946,1.819-1.788,.317-.857,.229-1.797-.242-2.582Zm-5.737-2.338l-5.831,1.946-5.833-1.951,5.825-1.942,5.839,1.946ZM2.156,7.428l1.292-2.145,7.048,2.357-1.529,2.549c-.239,.398-.735,.581-1.173,.434l-5.081-1.693c-.297-.099-.53-.324-.639-.618-.108-.293-.079-.616,.082-.883Zm1.843,4.038l3.163,1.054c1.343,.448,2.792-.088,3.521-1.302l.316-.526-.005,10.843-7-2.333,.006-7.735Zm8.994,10.068l.005-10.849,.319,.532c.556,.928,1.532,1.459,2.561,1.459,.319,0,.643-.051,.96-.157l3.161-1.053-.006,7.734-7,2.333Zm8.95-13.216c-.105,.285-.331,.503-.619,.599l-5.118,1.706c-.438,.147-.934-.035-1.173-.434l-1.526-2.543,7.051-2.353,1.305,2.167c.156,.26,.186,.573,.08,.858Z"/></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $totalProducts }}</span>
                                            <p>Total Products</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="javascript:;">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M15.74,3c.48,.6,.88,1.27,1.18,2h4.08v3h-3.5c0,4.41-3.59,8-8,8h-.83l9.57,8h-4.69L3,15.23v-2.23h6.5c2.76,0,5-2.24,5-5H3v-3H13.5c-.91-1.21-2.37-2-4-2H3V0H21V3h-5.26Z"/></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $settings->currency_icon ?? '' }}{{ $todaysEarnings }}</span>
                                            <p>Todays Earnings</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="javascript:;">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m11,6h2v6.437l-4.887,2.989-1.043-1.707,3.93-2.403v-5.315ZM2,12C2,6.486,6.486,2,12,2c3.559,0,6.878,1.916,8.663,5.001.707,1.224,1.13,2.591,1.271,3.999h2c-.147-1.759-.657-3.473-1.541-5.001C20.253,2.299,16.271,0,12,0,5.383,0,0,5.383,0,12c0,3.076,1.162,6.002,3.273,8.236.449.475.937.896,1.444,1.286l1.423-1.423c-.501-.365-.977-.773-1.414-1.236-1.758-1.862-2.727-4.3-2.727-6.863Zm20,1h-4v2h2.568l-4.693,4.692-3.25-3.25-6.063,6.062,1.414,1.414,4.648-4.648,3.25,3.25,6.125-6.124v2.604h2v-4c0-1.103-.897-2-2-2Z"/></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $settings->currency_icon ?? '' }}{{ $monthEarnings }}</span>
                                            <p>This Months Earnings</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="javascript:;">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m21,12.113v-6.035l1.293,1.293c.195.195.451.293.707.293s.512-.098.707-.293c.391-.391.391-1.023,0-1.414l-2.427-2.428c-.706-.702-1.854-.704-2.561,0l-2.426,2.427c-.391.391-.391,1.023,0,1.414s1.023.391,1.414,0l1.293-1.293v4.196c-1.581-1.152-3.436-1.919-5.417-2.173-.194-.025-.388-.028-.583-.043V3.078l1.293,1.293c.195.195.451.293.707.293s.512-.098.707-.293c.391-.391.391-1.023,0-1.414l-2.427-2.428c-.705-.702-1.854-.704-2.561,0l-2.426,2.427c-.391.391-.391,1.023,0,1.414s1.023.391,1.414,0l1.293-1.293v4.969c-2.162.184-4.236.947-6,2.213v-4.182l1.293,1.293c.195.195.451.293.707.293s.512-.098.707-.293c.391-.391.391-1.023,0-1.414l-2.427-2.428c-.705-.702-1.854-.704-2.561,0L.293,5.957c-.391.391-.391,1.023,0,1.414s1.023.391,1.414,0l1.293-1.293v6.001C1.084,14.258,0,17.188,0,20.121c.022,2.139,1.818,3.879,4.001,3.879h15.994c2.188,0,3.984-1.749,4.003-3.899.011-1.292-.197-2.586-.619-3.847-.518-1.551-1.341-2.95-2.381-4.141Zm-3.318,3.569l-3.768,3.769c.051.176.086.358.086.55,0,1.105-.895,2-2,2s-2-.895-2-2,.895-2,2-2c.164,0,.321.025.474.062l3.795-3.795c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414Z"/></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $settings->currency_icon ?? '' }}{{ $yearEarnings }}</span>
                                            <p>This Year Earnings</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="javascript:;">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Bold" viewBox="0 0 24 24"><path d="M18.5,0H13a1.5,1.5,0,0,0,0,3h5.5a2.43,2.43,0,0,1,.344.035l-18.4,18.4a1.5,1.5,0,0,0,2.122,2.122l18.4-18.4A2.43,2.43,0,0,1,21,5.5V11a1.5,1.5,0,0,0,3,0V5.5A5.507,5.507,0,0,0,18.5,0Z"/><path d="M6.5,11A4.5,4.5,0,1,0,2,6.5,4.505,4.505,0,0,0,6.5,11Zm0-6A1.5,1.5,0,1,1,5,6.5,1.5,1.5,0,0,1,6.5,5Z"/><path d="M17.5,13A4.5,4.5,0,1,0,22,17.5,4.505,4.505,0,0,0,17.5,13Zm0,6A1.5,1.5,0,1,1,19,17.5,1.5,1.5,0,0,1,17.5,19Z"/></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $settings->currency_icon ?? '' }}{{ $toalEarnings }}</span>
                                            <p>Total Earnings</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="{{ route('vendor.reviews.index') }}">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m23.763,6.597l-1.577,1.285.652,1.987c.089.269-.001.565-.226.738-.225.173-.534.185-.771.031l-1.836-1.196-1.805,1.208c-.112.075-.242.113-.371.113-.141,0-.282-.045-.4-.133-.227-.17-.321-.464-.236-.734l.627-2.011-1.585-1.29c-.213-.181-.291-.476-.194-.738.096-.262.346-.437.626-.437h2.001l.708-1.987c.097-.261.346-.434.625-.434s.528.173.625.434l.708,1.987h2.001c.28,0,.53.175.626.438.096.263.017.558-.197.739Zm-15.527-3.002l1.585,1.29-.627,2.011c-.085.27.01.564.236.734.118.089.259.133.4.133.129,0,.258-.037.371-.113l1.805-1.208,1.836,1.196c.237.154.546.142.771-.031.225-.173.315-.469.226-.738l-.652-1.987,1.577-1.285c.214-.18.293-.476.197-.739-.096-.263-.346-.438-.626-.438h-2.001l-.708-1.987c-.097-.261-.346-.434-.625-.434s-.528.173-.625.434l-.708,1.987h-2.001c-.28,0-.529.174-.626.437-.097.262-.019.557.194.738Zm-2.394,7.042c.237.154.546.142.771-.031.225-.173.315-.469.226-.738l-.652-1.987,1.577-1.285c.214-.18.293-.476.197-.739-.096-.263-.346-.438-.626-.438h-2.001l-.708-1.987c-.097-.261-.346-.434-.625-.434s-.528.173-.625.434l-.708,1.987H.667c-.28,0-.529.174-.626.437-.097.262-.019.557.194.738l1.585,1.29-.627,2.011c-.085.27.01.564.236.734.118.089.259.133.4.133.129,0,.258-.037.371-.113l1.805-1.208,1.836,1.196Zm14.1,6.951l-.639,3.196c-.374,1.87-2.016,3.216-3.922,3.216H7c-1.657,0-3-1.343-3-3v-4c0-1.657,1.343-3,3-3h1.456l2.193-4.149c.18-.352.428-.614.682-.719.212-.088.427-.132.64-.132.682,0,1.244.446,1.432,1.136.022.08.05.265-.007.599l-.58,3.265h4.183c1.893,0,3.313,1.732,2.942,3.588Zm-12.941,4.412h1v-6h-1c-.551,0-1,.449-1,1v4c0,.551.449,1,1,1Zm10.772-5.634c-.112-.137-.362-.366-.773-.366h-6.999v6h5.379c.95,0,1.775-.676,1.961-1.608l.639-3.196c.081-.404-.095-.693-.207-.83Z" /></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>{{ $totalReviews }}</span>
                                            <p>Total Reviews</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-xl-3 col-6 col-md-4 mb-4">
                                    <a class="dashboard_item" href="{{ route('vendor.shop-profile.index') }}">
                                        <div class="dashboard_icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m23,24h-8c-.311,0-.604-.145-.793-.391-.189-.247-.254-.567-.173-.868.591-2.203,2.633-3.741,4.966-3.741s4.375,1.538,4.966,3.741c.081.301.017.621-.173.868-.188.247-.482.391-.793.391Zm-4-6c-1.379,0-2.5-1.121-2.5-2.5s1.121-2.5,2.5-2.5,2.5,1.121,2.5,2.5-1.121,2.5-2.5,2.5Zm4.962-10.275l-1.172-4.099c-.61-2.135-2.588-3.626-4.808-3.626h-.982v4c0,.552-.447,1-1,1s-1-.448-1-1V0h-6v4c0,.552-.448,1-1,1s-1-.448-1-1V0h-.983C3.797,0,1.82,1.491,1.209,3.626L.039,7.725c-.025.089-.039.182-.039.275,0,2.206,1.794,4,4,4h1c1.2,0,2.266-.542,3-1.382.734.84,1.8,1.382,3,1.382h2c1.201,0,2.266-.542,3-1.382.734.84,1.799,1.382,3,1.382h1c2.206,0,4-1.794,4-4,0-.093-.013-.186-.038-.275Zm-11.859,14.495c.481-1.794,1.659-3.256,3.192-4.176-.499-.725-.795-1.6-.795-2.545,0-.652.146-1.268.396-1.827-.607.207-1.244.327-1.896.327h-2c-1.062,0-2.095-.288-3-.819-.905.531-1.938.819-3,.819h-1c-1.093,0-2.116-.299-3-.812v6.812c0,2.206,1.794,4,4,4h7.192c-.201-.568-.248-1.189-.089-1.78Z"/></svg>
                                        </div>
                                        <div class="dashboard_details">
                                            <span>-</span>
                                            <p>shop profile</p>
                                        </div>
                                    </a>
                                </div>










                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Today's Orders</p>
                                        <h4 style="color:#ffff">{{ $todaysOrder }}</h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Td's Pending Orders</p>
                                        <h4 style="color:#ffff">{{ $todaysPendingOrder }}</h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Orders</p>
                                        <h4 style="color:#ffff">{{ $totalOrder }}</h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Pending Orders</p>
                                        <h4 style="color:#ffff">{{ $totalPendingOrder }}</h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="{{ route('vendor.orders.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Completed Orders</p>
                                        <h4 style="color:#ffff">{{ $totalCompleteOrder }}</h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="{{ route('vendor.products.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Products</p>
                                        <h4 style="color:#ffff">{{ $totalProducts }}</h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Todays Earnings</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon ?? '' }}{{ $todaysEarnings }}
                                        </h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>This Months Earnings</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon ?? '' }}{{ $monthEarnings }}
                                        </h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>This Year Earnings</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon ?? '' }}{{ $yearEarnings }}
                                        </h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="javascript:;">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Earnings</p>
                                        <h4 style="color:#ffff">{{ $settings->currency_icon ?? '' }}{{ $toalEarnings }}
                                        </h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="{{ route('vendor.reviews.index') }}">
                                        <i class="fas fa-cart-plus"></i>
                                        <p>Total Reviews</p>
                                        <h4 style="color:#ffff">{{ $totalReviews }}</h4>
                                    </a>
                                </div> --}}
                                {{-- <div class="col-xl-2 col-6 col-md-4">
                                    <a class="dashboard_item red" href="{{ route('vendor.shop-profile.index') }}">
                                        <i class="fas fa-user-shield"></i>
                                        <p>shop profile</p>
                                        <h4 style="color:#ffff">-</h4>
                                    </a>
                                </div> --}}

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
