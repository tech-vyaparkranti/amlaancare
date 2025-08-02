<div class="top-ticker d-none">
    <div class="container-fluid">
        <div class="top-ticker-inner">
            <p class="text-center p-0">Shop For Rs.5000 & Get Rs.500 OFF*. Use Code:ESB500</p>
            <div class="call_text">
                <p><i class="fa fa-envelope-o"></i>&nbsp;{{$settings->contact_email}}</p>
                <p><i class="fa fa-phone"></i>&nbsp;{{$settings->contact_phone}}</p>
            </div>
        </div>
    </div>
</div>

{{-- <ul class="menu_item">
    <li><a  class="{{setActive(['home'])}}" href="{{url('/')}}">home</a></li>

    <li><a class="{{setActive(['vendor.index'])}}" href="{{route('vendor.index')}}">vendors</a></li>
    <li><a class="{{setActive(['flash-sale'])}}" href="{{route('flash-sale')}}">flash Sale</a></li>
    <li><a class="{{setActive(['blog'])}}" href="{{route('blog')}}">blog</a></li>
    <li><a class="{{setActive(['about'])}}" href="{{route('about')}}">about</a></li>
    <li><a class="{{setActive(['contact'])}}" href="{{route('contact')}}">contact</a></li>


</ul> --}}
{{-- <ul class="menu_item menu_item_right">
    <li><a href="{{route('product-traking.index')}}">track order</a></li>
    @if (auth()->check())
        @if (auth()->user()->role === 'user')
            <li><a href="{{route('user.dashboard')}}">my account</a></li>
        @elseif (auth()->user()->role === 'vendor')
            <li><a href="{{route('vendor.dashbaord')}}">Vendor Dashboard</a></li>
        @elseif (auth()->user()->role === 'admin')
            <li><a href="{{route('admin.dashbaord')}}">Admin Dashboard</a></li>
        @endif
    @else
        <li><a href="{{route('login')}}">login</a></li>
    @endif
</ul> --}}
<header>

    <div class="container-fluid">
        {{-- <div class="row"> --}}
        <div class="header-inner">
            {{-- <div class="col-xl-2 col-6 col-md-2 col-lg-2 logo"> --}}
            <div class="logo">
                <div class="mobile_menu_area d-lg-none">
                    <span class="mobile_menu_icon"><i class="fal fa-bars"></i></span>
                </div>
                <div class="wsus_logo_area">
                    <a class="header_logo" href="{{url('/')}}">
                        <img src="{{asset($logoSetting->logo)}}" alt="logo" class="img-fluid w-100">
                    </a>
                </div>
            </div>
            {{-- <div class="col-xl-5 col-md-6 col-lg-4 d-none d-lg-block">
                <div class="search">
                    <form action="{{route('products.index')}}">
                        <input type="text" placeholder="Search..." name="search" value="{{request()->search}}">
                        <button type="submit"><i class="far fa-search"></i></button>
                    </form>
                </div>
            </div> --}}
            {{-- <div class="col-xl-10 col-6 col-md-10 col-lg-10"> --}}
                @php
                    $categories = \App\Models\Category::where('status', 1)
                    ->with(['subCategories' => function($query){
                        $query->where('status', 1)
                        ->with(['childCategories' => function($query){
                            $query->where('status', 1);
                        }]);
                    }])
                    ->get();
                @endphp
                <div class="slide-navigation">
                    <div class="navbar-wrapper">
                        <ul class="navbar-block">
                            {{-- <li><a class="{{setActive(['home'])}}" href="{{url('/')}}">home</a></li> --}}
                            {{-- <li><a class="{{setActive(['about'])}} main-navigation-home mobile-about" href="{{route('about')}}">About Us</a></li> --}}
                            <li><a class="main-navigation-home shop-now-btn"  href="{{route('shop')}}">Shop now</a></li>
                            {{-- @foreach ($categories as $category)
                            <li class="{{count($category->subCategories) > 0 ? 'dropdown-list' : ''}}">
                                <i class="{{count($category->subCategories) > 0 ? 'drop-plus' : ''}}" hidden></i>
                                <a href="{{route('products.index', ['category' => $category->slug])}}">{{$category->name}}</a>
                                @if(count($category->subCategories) > 0)
                                <ul class="sublist">
                                    @foreach ($category->subCategories as $subCategory)
                                    <li class="{{count($category->subCategories) > 0 ? 'dropdown-list' : ''}}">
                                        <i class="{{count($subCategory->childCategories) > 0 ? 'drop-plus' : ''}}" hidden></i>
                                        <a href="{{route('products.index', ['subcategory' => $subCategory->slug])}}">{{$subCategory->name}}</a>
                                        @if(count($subCategory->childCategories) > 0)
                                        <ul class="sublist">
                                            @foreach ($subCategory->childCategories as $childCategory)
                                                <li><a href="{{route('products.index', ['childcategory' => $childCategory->slug])}}">{{$childCategory->name}}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach --}}
                            {{-- <li><a class="{{setActive(['gallery'])}}" href="{{route('gallery')}}">Memories</a></li>
                            <li><a class="{{setActive(['blog'])}}" href="{{route('blog')}}">Blog</a></li>
                            <li><a class="{{setActive(['contact'])}}" href="{{route('contact')}}">Reach Us</a></li> --}}
                        </ul>
                    </div>
                    <div class="call_icon_area">
                        <ul class="icon_area">
                            {{-- Track Order / login  --}}
                            <li><a href="{{route('product-traking.index')}}" title="Track Order"><i class="fal fa-truck"></i></a></li>
                            @if (auth()->check())
                                @if (auth()->user()->role === 'user')
                                    <li><a href="{{route('user.dashboard')}}" title="My Account"><i class="fi fi-ss-user"></i></a></li>
                                @elseif (auth()->user()->role === 'vendor')
                                    <li><a href="{{route('vendor.dashbaord')}}" title="Vendor Dashboard"><i class="fi fi-ss-seller"></i></a></li>
                                @elseif (auth()->user()->role === 'admin')
                                    <li><a href="{{route('admin.dashbaord')}}" title="Admin Dashboard"><i class="fi fi-ss-admin-alt"></i></a></li>
                                @endif
                            @else
                                <li><a href="{{route('login')}}" title="Login"><i class="fal fa-sign-in" aria-hidden="true"></i></a></li>
                            @endif
                            {{-- Track Order / login  --}}
                            <li><a href="{{route('user.wishlist.index')}}"><i class="fal fa-heart"></i><span id="wishlist_count">
                                @if (auth()->check())
                                {{\App\Models\Wishlist::where('user_id', auth()->user()->id)->count()}}
                                @else
                                0
                                @endif
                            </span></a></li>
                            {{-- <li><a href="compare.html"><i class="fal fa-random"></i><span>03</span></a></li> --}}
                            {{-- <li><a href="{{route('shop')}}" style="display: inline-block; padding: 10px;"><i class="fal fa-shopping-bag" style="font-size: 24px; color: #f9f4f4; margin-top: 4vh;"></i></a></li> --}}
                            {{-- <br> --}}
                            <li><a class="cart_icon" href="#"><i class="fal fa-shopping-bag"></i><span id="cart-count">{{Cart::content()->count()}}</span></a></li>

                        </ul>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>
    <div class="mini_cart">
        <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"></i></span></h4>
        <ul class="mini_cart_wrapper">
            @foreach (Cart::content() as $sidebarProduct)
                <li id="mini_cart_{{$sidebarProduct->rowId}}">
                    <div class="cart_img">
                        <a href="#"><img src="{{asset($sidebarProduct->options->image)}}" alt="product" class="img-fluid w-100"></a>
                        <a class="wsis__del_icon remove_sidebar_product" data-id="{{$sidebarProduct->rowId}}" href="#" ><i class="fas fa-minus-circle"></i></a>
                    </div>
                    <div class="cart_text">
                        <a class="cart_title" href="{{route('product-detail', $sidebarProduct->options->slug)}}">{{$sidebarProduct->name}}</a>
                        <p>
                            {{$settings->currency_icon}}{{$sidebarProduct->price}}
                        </p>
                        <small>Variants total: {{$settings->currency_icon}}{{$sidebarProduct->options->variants_total}}</small>
                        <br>
                        <small>Qty: {{$sidebarProduct->qty}}</small>
                    </div>
                </li>
            @endforeach
            @if (Cart::content()->count() === 0)
                <li class="text-center">Cart Is Empty!</li>
            @endif
        </ul>
        <div class="mini_cart_actions {{Cart::content()->count() === 0 ? 'd-none': ''}}">
            <h5>sub total <span id="mini_cart_subtotal">{{$settings->currency_icon}}{{getCartTotal()}}</span></h5>
            <div class="minicart_btn_area">
                <a class="common_btn" href="{{route('cart-details')}}">view cart</a>
                <a class="common_btn" href="{{route('user.checkout')}}">checkout</a>
            </div>
        </div>
    </div>

</header>

<style>
.slide-navigation {display: flex;justify-content: right;justify-items: center;align-items: center;line-height: 80px;margin-top: -10px;}
.navbar-block li {display: inline-block;position: relative;margin: auto 8px;padding: 0px 0;}
/* Navigation bar dropdown */
.sublist {visibility: hidden;opacity: 0;position: absolute;z-index: 1;background-color: #fff;width: 200px;box-shadow: var(--box-shadow);border-radius: 4px;top: 100%;transition: var(--transition);}
ul.sublist.active-list {visibility: visible;opacity: 1;}
ul.sublist li {display: block;padding: 0px 0px;position: relative;margin: auto 0;line-height: normal;height: auto;}
ul.sublist ul.sublist {left: 100%;top: 0;margin: 0 0;}
.sublist li.dropdown-list > .drop-plus + a:after,
li.dropdown-list > .drop-plus + a:after {content: '\f107';font-family: 'Font Awesome 5 Pro';transition: var(--transition);padding: 0 5px;}
.sublist li.dropdown-list > .drop-plus + a:after {position: absolute;right: 10px;top: 10px;}
.sublist li.dropdown-list:hover:after{transform: rotate(-90deg);}
li.dropdown-list:hover:after{transform: rotate(-90deg);}
ul.sublist li a {
    display: flex;
    padding: 2px 15px 2px 10px;
    margin: 0 0;
    height: auto;
    line-height: normal;
    border-top: 1px solid lightgray;
    min-height: 40px;
    align-items: center;
    color: #000;
}
.information .navbar-block > li a, .information .icon_area li a {color: #000;}
ul.sublist li a:hover {background-color: rgb(var(--gold-bg));}
@media (max-width: 768px){
    i.drop-plus {display: block !important;position: absolute;right: 10px;top: 10px;height: 25px;width: 25px;text-align: center;line-height: 20px;color: #fff;font-weight: 700;font-size: 28px;padding: 0px 0;background-color: rgb(var(--green-color));}
    .sublist {position: relative;display: none;width: 100%;top: 100%;margin: 10px 0 0 !important;transition: var(--transition);}
    ul.sublist ul.sublist{left: 0 !important;margin: 0 0 !important}
    .sublist li.dropdown-list .drop-plus + a:after{display: none;}
    ul.sublist.active {display: block;opacity: 1;visibility: visible;}
}
@media (min-width: 768px){
    li.dropdown-list:hover > ul.sublist, li.dropdown-list:hover ul.sublist > ul.sublist , ul.sublist.active-list {visibility: visible;opacity: 1;}
}
/* Navigation bar dropdown End */
/* a.main-navigation-home.shop-now-btn {
    font-size: 23px;
    padding: 10px;
} */
</style>
<script>
// Navigation bar dropdown
document.addEventListener('DOMContentLoaded', () => {
    // Code here runs after DOM content is fully loaded
    const dropdowns = document.querySelectorAll('.dropdown-list');
    dropdowns.forEach(dropdown => {
        const toggleBtn = dropdown.querySelector('.drop-plus');
        const sublist = dropdown.querySelector('.sublist');
        dropdown.addEventListener("mouseover", (event) => {
            const isDropdown = event.currentTarget === event.target;
            if (isDropdown) {
                sublist.classList.add('active-list');
            }
        });
        dropdown.addEventListener("mouseleave", () => {
            sublist.classList.remove('active-list');
        });
        if (toggleBtn && sublist) {
            toggleBtn.addEventListener('click', (event) => {
                sublist.classList.toggle('active');
                toggleBtn.textContent = sublist.classList.contains('active') ? '-' : '+';
                event.stopPropagation(); // Prevent event from bubbling up
            });
        //} else {
        //    console.error('Toggle button or sublist not found in dropdown:', dropdown);
        }
        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            if (sublist) {
                sublist.classList.remove('active');
                toggleBtn.textContent = '+';
            }
        });
        // Prevent closing dropdown when clicking inside
        dropdown.addEventListener('click', (event) => {
            event.stopPropagation();
        });
    });
});
window.addEventListener("load", function() {
        $(window).on('scroll', function () {
        if ($(window).scrollTop() > 150) {
            $('header').addClass('fixed-header');
        } else {
            $('header').removeClass('fixed-header');
        }
    });
});

// Navigation bar dropdown End

</script>
