@php
    $categories = \App\Models\Category::where('status', 1)
    ->with(['subCategories' => function($query){
        $query->where('status', 1)
        ->with(['childCategories' => function($query){
            $query->where('status', 1);
        }]);
    }])
    ->get();

    $sliders = Cache::rememberForever('sliders', function () {
            return \App\Models\Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        });
@endphp
{{-- <div class="top-ticker">
    <div class="container-fluid"> --}}
        <nav class="top-nav">
            <div class="left-menu">
                <a href="{{ route('vendorRegistration') }}" class="nav-item">Become A Seller</a>
                {{-- <a href="{{ route('about') }}" class="nav-item">About us</a> --}}
                {{-- <a href="#" class="nav-item">Free Delivery</a>
                <a href="#" class="nav-item">Returns Policy</a> --}}
            </div>
            <div class="top-ticker-inner-123">
                <p class="text-center p-0 " style="color: white">COD AVAILABLE | WORLDWIDE SHIPPING | FREE DELIVERY</p>
            </div>
            <div class="right-menu">
                <a href="#" class="nav-item dropdown">Help Center</a>
                {{-- <a href="#" class="nav-item dropdown">Eng</a>
                <a href="#" class="nav-item dropdown">USD</a> --}}
                {{-- <a href="#" class="nav-item"><span class="icon"><i class="fas fa-user"></i></span> My Account</a> --}}

            </div>
        </nav>
        {{-- <div class="top-ticker-inner">
            <p class="text-center p-0">COD AVAILABLE | WORLDWIDE SHIPPING | FREE DELIVERY</p>
        </div> --}}
    {{-- </div>
</div> --}}
<style>


    /* Top navigation bar styles */
    .top-nav {
        background-color: #4CAF50;
        color: white;
        padding: 12px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .left-menu, .right-menu {
        display: flex;
        align-items: center;
    }

    .nav-item {
        margin: 0 15px;
        text-decoration: none;
        color: white;
        font-size: 14px;
        cursor: pointer;
        position: relative;
    }

    .dropdown::after {
        content: "▼";
        font-size: 8px;
        margin-left: 5px;
        vertical-align: middle;
    }

    /* Promotional ticker styles */
    /* .container-fluid {
        background-color: #f8f8f8;
        padding: 8px 0;
        border-bottom: 1px solid #e0e0e0;
    } */

    .top-ticker-inner {
        width: 100%;
    }

    .text-center {
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

    .p-0 {
        padding: 0;
    }

    /* Icon styles */
    .icon {
        margin-right: 5px;
    }




/* Tablets and below (768px) */
@media (max-width: 768px) {
    .top-nav {
        flex-direction: row;
        padding: 10px;
    }
    .top-ticker-inner-123{
        display: none;
    }

    .left-menu, .right-menu {
        flex-direction: row;
        width: 100%;
        align-items: flex-start;
        gap:5px;
    }

    .nav-item {
        margin: 5px 0;
        font-size: 13px;
    }

    .dropdown::after {
        font-size: 7px;
    }
}

/* Mobile devices (480px and below) */
@media (max-width: 480px) {
    .top-nav {
        padding: 8px;
    }

    .top-ticker-inner-123{
        display: none;
    }
    .nav-item {
        font-size: 12px;
        margin: 5px 0;
    }

    .left-menu, .right-menu {
        align-items: center;
        text-align: center;
        gap: 5px;
    }

    .top-ticker-inner {
        font-size: 12px;
    }

    .dropdown::after {
        font-size: 6px;
    }
}

/* iPad Mini / iPad Air / iPad Pro 11" (Portrait & Landscape) */
@media (min-width: 769px) and (max-width: 1024px) {
    .top-nav {
        flex-direction: row;
        padding: 12px;
    }

    .top-ticker-inner-123 {
        display: block;
    }

    .left-menu, .right-menu {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        gap: 8px;
    }

    .nav-item {
        font-size: 14px;
        margin: 0 10px;
    }
}

/* iPad Pro 12.9" */
@media (min-width: 1025px) and (max-width: 1366px) {
    .top-nav {
        padding: 14px;
    }

    .top-ticker-inner-123 {
        display: block;
    }

    .left-menu, .right-menu {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .nav-item {
        font-size: 15px;
        margin: 0 12px;
    }
}

</style>

{{-- second header part --}}

{{-- <style>

    .top-nav-2 {
        background-color: #f8fdf4;
        padding: 12px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .logo-2 {
        display: flex;
        align-items: center;
    }

    .logo-2 img {
        height: 40px;
        margin-right: 8px;
    }

    .logo-2 span {
        font-size: 24px;
        font-weight: bold;
        color: #4CAF50;
    }

    .search-container-2 {
        display: flex;
        flex-grow: 1;
        max-width: 600px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
    }

    .search-container-2 select,
    .search-container-2 input {
        border: none;
        padding: 10px;
        outline: none;
    }

    .search-container-2 select {
        background: #f5f5f5;
    }

    .search-container-2 input {
        flex: 1;
    }

    .search-container-2 button {
        background-color: #4CAF50;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        color: white;
    }

    .right-menu-2 {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .location-2 {
        background-color: white;
        border: 1px solid #ddd;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
    }

    .location-2 span {
        font-weight: bold;
    }

    .icon-2 {
        display: flex;
        align-items: center;
        cursor: pointer;
        position: relative;
    }

    .icon-2 img {
        height: 20px;
        margin-right: 5px;
    }

    .icon-badge-2 {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: #4CAF50;
        color: white;
        font-size: 12px;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Responsive adjustments */

    @media (max-width: 768px) {
        .top-nav-2 {
            flex-direction: column;
            align-items: flex-start;
        }

        .search-container-2 {
            width: 100%;
            margin: 10px 0;
        }

        .right-menu-2 {
            width: 100%;
            justify-content: space-between;
        }
    }

    @media (max-width: 480px) {
        .top-nav-2 {
            padding: 8px;
        }

        .search-container-2 select,
        .search-container-2 input,
        .search-container-2 button {
            padding: 8px;
        }

        .right-menu-2 {
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }

        .location-2 {
            font-size: 12px;
        }
    }
</style>
<nav class="top-nav-2">

    <!-- Logo -->
    <div class="logo-2">
        <img src="https://via.placeholder.com/40" alt="Logo">
        <span>Marketpro</span>
    </div>

    <!-- Search Bar -->
    <div class="search-container-2">
        <select>
            <option>All Categories</option>
            <option>Groceries</option>
            <option>Electronics</option>
        </select>
        <input type="text" placeholder="Search for a product or brand">
        <button>🔍</button>
    </div>

    <!-- Right Menu -->
    <div class="right-menu-2">


        <div class="icon-2">
            ❤️ Wishlist
            <span class="icon-badge-2">2</span>
        </div>

        <div class="icon-2">
            🛒 Cart
            <span class="icon-badge-2">2</span>
        </div>
    </div>
</div>

</nav> --}}
{{-- second header part --}}
{{-- <ul class="menu_item">
    <li><a  class="{{setActive(['home'])}}" href="{{url('/')}}">home</a></li>

    <li><a class="{{setActive(['vendor.index'])}}" href="{{route('vendor.index')}}">vendors</a></li>
    <li><a class="{{setActive(['flash-sale'])}}" href="{{route('flash-sale')}}">flash Sale</a></li>
    <li><a class="{{setActive(['blog'])}}" href="{{route('blog')}}">blog</a></li>
    <li><a class="{{setActive(['about'])}}" href="{{route('about')}}">about</a></li>
    <li><a class="{{setActive(['contact'])}}" href="{{route('contact')}}">contact</a></li>


</ul> --}}
{{-- <ul class="menu_item menu_item_right">
    <li><a href="{{route('product-traking.index')}}">Track order</a></li>
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
                    <span class="mobile_menu_icon" ><i class="fal fa-bars" ></i></span>
                </div>
                <div class="wsus_logo_area">
                    <a class="header_logo" href="{{url('/')}}">
                        <img src="{{asset($logoSetting->logo ?? '')}}" alt="logo" class="img-fluid w-100">
                    </a>
                </div>
            </div>

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
                    <div class="navbar-wrapper d-none d-lg-block">

                        <ul class="navbar-block ">
                            {{-- <li>
                                <a class="main-navigation-home shop-now-btn" href="{{ route('home') }}">About Jikaka</a>
                            </li>
                            <li>
                                <a class="main-navigation-home shop-now-btn" href="{{ route('blog') }}">Blogs</a>
                            </li> --}}

                            @foreach ($categories as $category)
                            <li class="{{ count($category->subCategories) > 0 ? 'dropdown-list' : '' }}">
                                <i class="{{ count($category->subCategories) > 0 ? 'drop-plus' : '' }}" hidden></i>
                                <a class="main-navigation-home" href="{{ route('products.index', ['category_slug' => $category->slug]) }}">{{ $category->name }}</a>

                                @if (count($category->subCategories) > 0)
                                <ul class="sublist">
                                    @foreach ($category->subCategories as $subCategory)
                                    <li class="{{ count($subCategory->childCategories) > 0 ? 'dropdown-list' : '' }}">
                                        <i class="{{ count($subCategory->childCategories) > 0 ? 'drop-plus' : '' }}" hidden></i>
                                        <a href="{{ route('products.index', ['category_slug' => $category->slug, 'subcategory_slug' => $subCategory->slug]) }}">{{ $subCategory->name }}</a>

                                        @if (count($subCategory->childCategories) > 0)
                                        <ul class="sublist">
                                            @foreach ($subCategory->childCategories as $childCategory)
                                            <li>
                                                <a href="{{ route('products.index', ['category_slug' => $category->slug, 'subcategory_slug' => $subCategory->slug, 'childcategory_slug' => $childCategory->slug]) }}">{{ $childCategory->name }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                            @endforeach
                        </ul>

                    </div>

                    <div class="call_icon_area">
                        <ul class="icon_area">

                            {{-- Track Order / login  --}}
                            {{-- <li><a href="{{route('product-traking.index')}}" title="Track Order"><i class="fal fa-truck"></i></a></li> --}}
                            <div class="search">
                                <form action="{{route('products.index')}}" class="search-container">
                                    <input type="text" id="search-box"  placeholder="Search..." name="search" value="{{request()->search}}">
                                    <span id="search-icon"><i class="fal fa-search"></i></span>
                                </form>
                            </div>
                            <script>
                                document.getElementById('search-icon').addEventListener('click', function(event) {
                                     const searchBox = document.getElementById('search-box');
                                     searchBox.classList.toggle('active');
                                     searchBox.focus();
                                     event.stopPropagation();
                                 });
                                 document.addEventListener('click', function(event) {
                                     const searchBox = document.getElementById('search-box');
                                     const searchIcon = document.getElementById('search-icon');
                                     if (!searchBox.contains(event.target) && event.target !== searchIcon) {
                                         searchBox.classList.remove('active');
                                     }
                                 });
                             </script>
                             <style>
.search-container{
    border: none !important;
    box-shadow: none !important;

}
input#search-box {
  padding: 0 15px;
  color: rgb(var(--brown-color));
  height: 45px;
  width: 45px;
  opacity: 0;
  visibility: hidden;
  box-shadow: none;
  transition: all 500ms ease;
  margin-left: auto;
}
input#search-box.active {
  width: 100%;
  opacity: 1;
  visibility: visible;
}

#search-icon {
  position: absolute;
  font-size: 21px;
  right: 15px;
  color: rgb(var(--color-black));
  cursor: pointer;
}

@media (max-width: 767px) {
    #search-icon {
        display: none !important;
    }
}                  </style>

<li><a href="{{route('user.wishlist.index')}}"><i class="fal fa-heart"></i><span id="wishlist_count">
    @if (auth()->check())
    {{\App\Models\Wishlist::where('user_id', auth()->user()->id)->count()}}
    @else
    0
    @endif
</span></a></li>

                            @if (auth()->check())
                                @if (auth()->user()->role === 'user')
                                    <li><a href="{{route('user.dashboard')}}" title="My Account"><i class="fi fi-ss-user"></i></a></li>
                                @elseif (auth()->user()->role === 'vendor')
                                    <li><a href="{{route('vendor.dashbaord')}}" title="Vendor Dashboard"><i class="fi fi-ss-seller"></i></a></li>
                                @elseif (auth()->user()->role === 'admin')
                                    <li><a href="{{route('admin.dashbaord')}}" title="Admin Dashboard"><i class="fi fi-ss-admin-alt"></i></a></li>
                                @endif
                            @else
                                <li><a href="{{route('login')}}" title="Login"><i class="far fa-user-circle" aria-hidden="true"></i></a></li>
                            @endif
                            <li><a class="cart_icon" href="{{route('cart-details')}}"><i class="fal fa-shopping-bag"></i><span id="cart-count">{{Cart::content()->count()}}</span></a></li>
                        </ul>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
    </div>




    {{-- <div class="mini_cart">
        <h4>shopping cart <span class="wsus_close_mini_cart"><i class="far fa-times"  ></i></span></h4>
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
                            {{$settings->currency_icon ?? ''}}{{$sidebarProduct->price ?? ''}}
                        </p>
                        <small>Variants total: {{$settings->currency_icon ?? ''}}{{$sidebarProduct->options->variants_total}}</small>
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
            <h5>sub total <span id="mini_cart_subtotal">{{$settings->currency_icon ?? ''}}{{getCartTotal()}}</span></h5>
            <div class="minicart_btn_area" style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                <a class="common_btn" href="{{route('cart-details')}}">view cart</a>
                {{-- <a class="common_btn" href="{{route('user.checkout')}}">checkout</a> --}}
            </div>

        </div>
    {{-- </div> --}} 

</header>
<section id="banner">
    <div class="banner_content">
        <div class="banner_slider">
            @foreach ($sliders as $slider)
                @if ($slider->status == 1) <!-- Make sure the slider is active -->
                    <div class="mainSingle_slider">
                        <a href="{{$slider->btn_url}}" class="d-block">
                            <img src="{{$slider->banner}}" srcset="{{$slider->banner}}, {{$slider->banner}}, {{$slider->mobile_banner}} 767w" class="img-fluid" alt="e-commerce" />
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>


<section class="category-section">
    <div class="container">
        <ul class="categoryList">
            @if (count($categories))
                @foreach ($categories as $item)
                    <li><a href="{{ route('products.index', ['category_slug' => $item->slug]) }}"><img
                                src="{{ asset('storage/' . $item->image) }}" alt="" height="100" width="100"
                                class="img-fluid"><span style="font-weight: 700; font-size: 16px; margin-top: 10px;">{{$item->name}}</span></a></li>

                @endforeach
            @else
                <li><a href="#"><img src="https://dummyimage.com/150x150/cfcfcf/363636.png" alt="" height="100" width="100"
                            class="img-fluid"><span>Category-demo</span></a></li>
                <li><a href="#"><img src="https://dummyimage.com/150x150/cfcfcf/363636.png" alt="" height="100" width="100"
                            class="img-fluid"><span>Category-demo</span></a></li>
                <li><a href="#"><img src="https://dummyimage.com/150x150/cfcfcf/363636.png" alt="" height="100" width="100"
                            class="img-fluid"><span>Category-demo</span></a></li>
                <li><a href="#"><img src="https://dummyimage.com/150x150/cfcfcf/363636.png" alt="" height="100" width="100"
                            class="img-fluid"><span>Category-demo</span></a></li>
                <li><a href="#"><img src="https://dummyimage.com/150x150/cfcfcf/363636.png" alt="" height="100" width="100"
                            class="img-fluid"><span>Category-demo</span></a></li>
                <li><a href="#"><img src="https://dummyimage.com/150x150/cfcfcf/363636.png" alt="" height="100" width="100"
                            class="img-fluid"><span>Category-demo</span></a></li>

            @endif

        </ul>
    </div>
</section>

<style>
    li a img.img-fluid {
        transition: transform 0.5s ease, box-shadow 0.5s ease;
    }

    li a:hover img.img-fluid {
        transform: scale(0.9);
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
</style>
<style>
.categoryList {
    margin: 1rem auto;
    text-align: center;
    display: flex;
    overflow: auto;
    /* justify-content: center; */
    grid-gap: 30px !important;
}
.category-section .container {
    text-align: center;
    margin: auto;
    display: flex;
}
/* .categoryList > li{ */
.categoryList > li img{
    border-radius: 50%;
}
.categoryList > li >a, .categoryList > li >a >span {
    display: block;
    width: 100%;
    font: 400 13px/normal var(--font-three);
    margin-bottom: 10px;
    margin-top: 10px;
    letter-spacing: 1px;
}
</style>

<style>
.slide-navigation {
    display: flex;
    justify-content: right;
    justify-items: center;
    align-items: center;
    line-height: 70px;
    width: 100%;
}
/* .slide-navigation {display: flex;justify-content: right;justify-items: center;align-items: center;line-height: 70px;margin-top: -20px;} */
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
}
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
/* New Desktop */
.navbar-wrapper.d-none.d-lg-block {
    margin: auto;
    width: 100%;
    text-align: center;
    position: absolute;
}
}
/* Navigation bar dropdown End */
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
        // } else {
           // console.error('Toggle button or sublist not found in dropdown:', dropdown);
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
// Navigation bar dropdown End

</script>
