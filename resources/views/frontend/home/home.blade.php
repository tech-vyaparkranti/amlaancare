@extends('frontend.layouts.master2')
@section('title')
{{$settings->site_name}} || Shop
@endsection

@section('content')
{{-- <section class="category-section">
    <div class="container">
        <ul class="categoryList">
            <li>
                <a href="https://www.venuses.in/products/beauty">
                    <img src="./frontend/images/spices.jpg" alt="" height="100" width="100" class="img-fluid">
                    <span>turmeric</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="./frontend/images/spices2.jpg" alt="" height="100" width="100" class="img-fluid">
                    <span>cumin</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="./frontend/images/spices.jpg" alt="" height="100" width="100" class="img-fluid">
                    <span>turmeric</span>
                </a>
            </li>

            <!-- <li>
                <a href="#">
                    <img src="./frontend/images/spices.jpg" alt="" height="100" width="100" class="img-fluid">
                    <span>Footwear</span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="./frontend/images/spices.jpg" alt="" height="100" width="100" class="img-fluid">
                    <span>Home Furnishing</span>
                </a>
            </li> -->
        </ul>
    </div>
</section> --}}
<!--============================
    BANNER PART 2 START
    ==============================-->
    @include('frontend.home.sections.banner')
    <!--============================
        BANNER PART 2 END
    ==============================-->

    {{-- Home About us section --}}


    <section class="about-us mt-5 mb-sm-5">
        <div class="container">
            <div class="row">
                <!-- Left Column (Image Slider) -->
                <div class="col-md-6">
                    <div class="image-slider" style="box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); border-radius: 8px; overflow: hidden; transition: transform 0.3s ease-in-out;">
                        @if ($aboutUsImages && count($aboutUsImages) > 0)
                            @foreach ($aboutUsImages as $image)
                                <div class="image-container-main-header" >
                                    {{-- <img data-aos="zoom-in" data-aos-duration="1500" data-aos-offset="50" src="{{ asset('storage/' . $image) }}" alt="anydany's" class="img-fluid" /> --}}
                                    <img
                                    data-aos="zoom-in"
                                    data-aos-duration="1500"
                                    data-aos-offset="50"
                                    src="{{ asset('storage/' . $image) }}"
                                    alt="anydany's"
                                    class="img-fluid"
                                    style="transition: transform 0.3s ease-in-out;"
                                    onmouseover="this.style.transform='scale(1.05)'"
                                    onmouseout="this.style.transform='scale(1)'"
                                />
                                </div>
                            @endforeach
                        @else
                            <p>No images available.</p>
                        @endif
                    </div>
                </div>

                <!-- Right Column (About Us Content) -->
                <div class="col-md-6">
                    <div class="about-us_content" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="site-title text-left">
                            <span class="small-title">About Us</span>
                            <h3><span>About Our Company</span></h3>
                        </div>

                        <!-- Dynamic short description or static fallback -->
                        <p>
                            @if($latestHomeDetail && $latestHomeDetail?->about_us_short_description)
                            {!! $latestHomeDetail->about_us_short_description !!}
                            @else
                                Jikaka Pvt Ltd. a company based in India, Seed funded from Rashtriya Krishi Vikas Yojana. Originated from the princely state of Rajasthan(India), is emerging as a leading value-added supply chain management in cumin producer IPM Organic food. The company is aggressively propagating the technique of organic farming in the regions mainly encompassing virgin landscape and is evolving as a reliable brand for organic food.
                            @endif
                        </p>

                        <a href="{{ route('about') }}" class="btn btn-primary">Know more</a>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <style>
.about-us_figure {
    display: inline-flex;
    align-items: baseline;
    width: 100%;
}
/* .about-us_figure img:last-child, .about-us_figure img:first-child {
    display: block;
    width: calc(100% / 2);
    position: relative;
    bottom: -20px;
} */
/* .about-us_figure img:first-child {
    width: calc(100% / 2 + 15%);
    margin-right: -15%;
    top: -20px;
} */
.athlete_btn,
.chairperson-content > a,
.about-us_content > a {
    background-color: transparent;
    height: 45px;
    padding: 10px 20px;
    font: 700 13px/45px var(--font-mulish);
    color: rgb(var(--color-black));
    text-transform: uppercase;
    display: inline-block;
    margin: 1rem auto 1.5rem;
    border: 1px solid rgb(var(--color-black));
    transition: var(--transition);
    border-radius: 30px;
}
.athlete_btn:hover,
.chairperson-content > a:hover,
.about-us_content > a:hover {
    color: rgb(var(--color-white));
    background-color: rgb(69 140 53 / 95%);
    border:none;
}
.about-us_content > p {
    font: 300 14px/24px var(--font-open);
    margin-bottom: 10px;
    color: rgb(var(--color-black));
    text-align: justify;
}
.about-us_figure img {
    width: 100%;
    margin-bottom: 10px;
    max-height: 400px;
    min-height: 400px;
    border-radius: 20px;
    box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.3);
}
@media (min-width: 768px) and (max-width: 991px){
    .about-us_figure {display: block;}
    /* .about-us_figure img:last-child, .about-us_figure img:first-child{width: 100%; position: static;margin-bottom: 10px} */
}
    </style>
    <!-- Include Slick CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script>
    $(document).ready(function(){
        // Initialize the Slick Carousel
        $('.image-slider').slick({
            dots: true,           // Show dots for navigation
            infinite: true,       // Infinite looping
            speed: 500,           // Slide transition speed
            slidesToShow: 1,      // Show one image at a time
            slidesToScroll: 1,    // Scroll one image at a time
            autoplay: true,       // Autoplay the carousel
            autoplaySpeed: 3000,  // Speed of autoplay in milliseconds
            arrows: true,         // Show next/prev arrows
        });
    });
</script>

<!-- Optional AOS Animation for Image Zoom-In -->
<style>
    .about-us_figure .slick-slide img {
        transition: transform 0.5s ease;
    }
    .about-us_figure .slick-slide img:hover {
        transform: scale(1.05);
    }
</style>
    {{-- Home About us section --}}



    {{-- athlete slider  --}}

    {{-- <section class="athlete">
        <div class="container">
            <div class="athleteSlide mt-4 mb-3">
                <div class="athleteSlide_item" data-aos="fade-left">
                    <img data-fancybox="gallery" src="{{ url('/') }}/frontend/images/aboutImg_1.jpeg" alt="" width="" height="" class="img-fluid" />
                </div>
                <div class="athleteSlide_item" data-aos="fade-left">
                    <img data-fancybox="gallery" src="{{ url('/') }}/frontend/images/aboutImg_2.jpeg" alt="" width="" height="" class="img-fluid" />
                </div>
                <div class="athleteSlide_item" data-aos="fade-left">
                    <img data-fancybox="gallery" src="{{ url('/') }}/frontend/images/aboutImg_3.jpeg" alt="" width="" height="" class="img-fluid" />
                </div>
                <div class="athleteSlide_item" data-aos="fade-left">
                    <img data-fancybox="gallery" src="{{ url('/') }}/frontend/images/aboutImg_4.jpeg" alt="" width="" height="" class="img-fluid" />
                </div>
                <div class="athleteSlide_item" data-aos="fade-left">
                    <img data-fancybox="gallery" src="{{ url('/') }}/frontend/images/aboutImg_5.jpeg" alt="" width="" height="" class="img-fluid" />
                </div>
                <div class="athleteSlide_item" data-aos="fade-left">
                    <img data-fancybox="gallery" src="{{ url('/') }}/frontend/images/about-sports.jpg" alt="" width="" height="" class="img-fluid" />
                </div>
            </div>
            <div class="text-center">
                <a class="athlete_btn" href="{{ route('gallery') }}">Know more</a>
            </div>
        </div>
    </section> --}}
    <style>
.athleteSlide_item {
    padding: 10px;
}
.athleteSlide_item >img{width: 100%}
.athleteSlide .slick-arrow {
    position: absolute;
    top: -40px;
    right: 10px;
    width: 40px;
    background-color: transparent;
    text-align: center;
    font-family: 'Font Awesome 5 Free';
    color: rgb(var(--red-color));
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0px;
    border: 1px solid rgb(var(--red-color));
    cursor: pointer;
    transition: var(--transition);
}
.athleteSlide .slick-arrow:hover{
    background-color: rgb(var(--red-color));
    color: rgb(var(--white-color));
}
.athleteSlide .slick-arrow.prv_arr {right: 60px;}
</style>

    {{-- athlete slider End --}}


    {{-- Midd Static Content --}}
    <section class="chairperson">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-6 col-lg-4">
                    <div class="chairperson-figure pb-5" data-aos="fade-right"data-aos-duration="1500" data-aos-offset="50">
                        <img src="{{ asset('storage/' . $latestHomeDetail?->founder_image) }}" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50" width="" height="" class="img-fluid" alt="Chairperson's" />
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-8">
                    <div class="chairperson-content" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h3>Message from Founder Desk</h3>
                        <p>
                            {!! $latestHomeDetail->message_from_founder ?? 'Default message if none available' !!}
                        </p>
                </div>
                <p><span class="chairperson-name">({{ $latestHomeDetail->founder_name ?? 'Founder Name' }})</span></p>

                        {{-- <a href="{{ route('founder') }}">Know more</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Midd Static Content End --}}



    <!--============================
        FLASH SELL START
    ==============================-->
    {{-- @include('frontend.home.sections.flash-sale') --}}
    <!--============================
        FLASH SELL END
    ==============================-->



    <!--============================
       MONTHLY TOP PRODUCT START
    ==============================-->
    {{-- @include('frontend.home.sections.top-category-product')  --}}
    <!--============================
       MONTHLY TOP PRODUCT END
    ==============================-->


    <!--============================
        BRAND SLIDER START
    ==============================-->
    {{-- @include('frontend.home.sections.brand-slider') --}}
    <!--============================
        BRAND SLIDER END
    ==============================-->


    <!--============================
        SINGLE BANNER START
    ==============================-->
    @include('frontend.home.sections.single-banner')
    <!--============================
        SINGLE BANNER END
    ==============================-->


    <!--============================
        HOT DEALS START
    ==============================-->
    {{-- @include('frontend.home.sections.hot-deals') --}}
    <!--============================
        HOT DEALS END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    {{-- @include('frontend.home.sections.category-product-slider-one') --}}
    <!--============================
        ELECTRONIC PART END
    ==============================-->


    <!--============================
        ELECTRONIC PART START
    ==============================-->
    {{-- @include('frontend.home.sections.category-product-slider-two') --}}

    <!--============================
        ELECTRONIC PART END
    ==============================-->



    <!--============================
        WEEKLY BEST ITEM START
    ==============================-->
    {{-- @include('frontend.home.sections.weekly-best-item') --}}
    <!--============================
        WEEKLY BEST ITEM END
    ==============================-->




    {{-- Journey section --}}
    <section class="home_journery">
        <div class="container">

        </div>
    </section>
    {{-- Journey section End --}}


    {{-- Visitor Section  --}}
    <section class="home_Visitor pt-5 pb-5">
        <div class="container">
            <div class="site-title text-center pb-4 mb-4">
                {{-- <span class="small-title">anydany's</span> --}}
                <h3 class="pb-4"><span>Introducing  Jikaka's Organic Produces</span></h3>
                {{-- <p></p> --}}
            </div>
            <div class="promo-container">
                <div class="promo-left_grid promo_grid">
                    <div class="promo-figure" data-aos="zoom-in" data-aos-duration="1500" data-aos-offset="50">
                        @if($latestSupplyChain && $latestSupplyChain->image)
                <img src="{{ asset('storage/' . $latestSupplyChain->image) }}" alt="Supply Chain Image" width="" height="" class="img-fluid">
            @else
                <!-- Static Default Image -->
                <img src="./frontend/images/nc2.png" alt="" width="" height="" class="img-fluid">
                @endif
                        <div class="promo-promo-figure">
                            <span class="promo-figure_1 promo-figure_item"></span>
                            <span class="promo-figure_2 promo-figure_item"></span>
                            <span class="promo-figure_3 promo-figure_item"></span>
                            <span class="promo-figure_4 promo-figure_item"></span>
                            <span class="promo-figure_5 promo-figure_item"></span>
                            <span class="promo-figure_6 promo-figure_item"></span>
                        </div>
                    </div>
                </div>
                <div class="promo-right_grid promo_grid">
                   <div class="midd-content mt-3">
                    @if($latestSupplyChain)
                    <h3 data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">{{ $latestSupplyChain->title }}</h3>
                    <p data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">{{ $latestSupplyChain->content }}</p>
                @else
                    <h3 data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">SUPPLY CHAIN MANAGEMENT</h3>
                    <p data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">We currently collaborate with a group of 3000 farmers who are dedicated to producing organic and IPM spices. Their steadfast commitment to organic farming, coupled with the global surge in demand for high-quality organic foods, has inspired our organization to expand into a comprehensive organic food chain.</p>
                @endif
                <div id="promo-list" class="promo-list">
                    @foreach($qaArray as $key => $qa)
                        <div class="promo-list_items" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="accordion-button @if($key === 0) show @endif"
                                 data-bs-toggle="collapse"
                                 data-bs-target="#collapse{{ $key }}"
                                 aria-expanded="@if($key === 0) true @else false @endif"
                                 aria-controls="collapse{{ $key }}">
                                {{ $qa['question'] }}
                            </div>
                            <div id="collapse{{ $key }}" class="accordion-collapse collapse @if($key === 0) show @endif"
                                 aria-labelledby="heading{{ $key }}"
                                 data-bs-parent="#promo-list">
                                <p>{{ $qa['answer'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                    </div>
                </div>
            </div>
            <div class="bottom-content mb-5 pt-4 mt-4" >
                <h3 class="mb-2 pt-4" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">Jikaka: Organic Goodness for a Vibrant Life.</h3>
                <p data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">Jikaka offers a range of delicious and nutritious organic fruits, vegetables, and other farm-fresh produce, grown without harmful chemicals for a healthier you and a sustainable planet."</p>
            </div>
            <div class="workout-time swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="workout-product_card text-center">
                            <img src="./frontend/images/cuminseed.png" alt="" class="img-fluid">
                            <h5>CUMIN / CUMINUM CYMINUM</h5>
                            <span>Area of origin -Barmer & Jaisalmer</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="workout-product_card text-center">
                            <img src="./frontend/images/ajwain.png" alt="" class="img-fluid">
                            <h5>Ajwain / Trachyspermum Ammi</h5>
                            <span>Area of Origin -Jalore & Nagore</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="workout-product_card text-center">
                            <img src="./frontend/images/dillseed.png" alt="" class="img-fluid">
                            <h5>Dill Seed/Anethum Graveolens</h5>
                            <span>Area of Origin – Nagore</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="workout-product_card text-center">
                            <img src="./frontend/images/coriander.png" alt="" class="img-fluid">
                            <h5>Coriander / Coriandrum Sativam</h5>
                            <span>Area of Origin - Jalore & Jhalawar</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="workout-product_card text-center">
                            <img src="./frontend/images/fennel.png" alt="" class="img-fluid">
                            <h5>Fennel Seed/ Foeniculum Vulgare</h5>
                            <span>Area of Origin - Jalore& Sirohi</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="workout-product_card text-center">
                            <img src="./frontend/images/flaxseed.png" alt="" class="img-fluid">
                            <h5>Flax seed / Linum Usitatissimum
                                </h5>
                            <span>Area of Origin - Mandsaur </span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="workout-product_card text-center">
                            <img src="./frontend/images/fenugreek.png" alt="" class="img-fluid">
                            <h5>Fenugreek /Trigonella Foenum Graecum
                                </h5>
                            <span>Area of Origin - Jalore & Jhalawar</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="workout-product_card text-center">
                            <img src="./frontend/images/seasame.png" alt="" class="img-fluid">
                            <h5>Sesame Seed /Sesamum Indicum
                                </h5>
                            <span>Area of Origin - Barmer, Sirohi & Pali</span>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="workout-product_card text-center">
                            <img src="./frontend/images/psyllium.png" alt="" class="img-fluid">
                            <h5>Psyllium/Plantago Psyllium
                                </h5>
                            <span> Area of Origin –Barmer</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<style>
section.home_Visitor {
    /* background: url('./frontend/images/Asset-1.png'); */
    background-size: 400px;
    background-position: bottom right;
    background-repeat: repeat-x;
    padding-bottom: 150px !important;
    /* background: rgb(var(--black-color) / 20%); */
}
.promo-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 15px;
    margin: 1rem auto 2rem;
    position: relative;
    align-items: center
}
.accordion-button.collapsed {
    border: 1px solid #fff;
}
.accordion-button:not(.collapsed) {
    border: 1px solid #fff;
}
.bottom-content > h3,
.midd-content h6,
.midd-content h3 {
    font: 700 24px;
    margin: 0 auto 1rem;
    color: rgb(var( --color-green));
}
.midd-content h6{
    font: 700 16px;
    color: rgb(var(--black-color));
    margin-bottom: 5px;
}
.bottom-content > p,
.midd-content .accordion-collapse > p,
.midd-content p {
    font: 400 14px;
    letter-spacing: 0.5px;
    margin: 0 auto 10px;
    color: rgb(var(--black-color)) !important;
    text-align: justify;
}
#promo-list .accordion-button {
    background-color: transparent !important;
    font-weight: 700;
    padding: 0.5rem 0;
    cursor: pointer;
}
.promo-figure {
    position: relative;
}
.promo-promo-figure > span.promo-figure_1 {background-image: url('frontend/images/bg-gluten-free-preview.png');top: 5%;left: 5%;z-index: 1;animation-delay: 1s;}
.promo-promo-figure > span.promo-figure_2 {background-image: url('frontend/images/bg-lab-tested-preview.png');top: -10%;left: 48%;z-index: 0;animation-delay: 2s;}
.promo-promo-figure > span.promo-figure_3 {background-image: url('frontend/images/bg-performance-preview.png');right: 65%;bottom: 8%;z-index: 1;animation-delay: 1.5s;}
.promo-promo-figure > span.promo-figure_4 {background-image: url('frontend/images/bg-preservatives-preview.png');left: calc(95% - 100px);bottom: calc(88% - 100px);z-index: 1;animation-delay: 0s;}
.promo-promo-figure > span.promo-figure_5 {background-image: url('frontend/images/bg-synthetic-preview.png');right: calc(48% - 100px);bottom: calc(32% - 100px);z-index: 1;animation-delay: 0.5s;}
.promo-promo-figure > span.promo-figure_6 {background-image: url('frontend/images/bg-two-years-preview.png');bottom: calc(84% - 100px);top: calc(58% - 100px);z-index: 1;animation-delay: 2.5s;}
.promo-promo-figure > span {
    position: absolute;
    background-repeat: no-repeat;
    animation: bounce 3s ease-in-out infinite;
    height: calc(100% - 80%);
    width: calc(100% - 80%);
    background-size: contain;
    filter: drop-shadow(var(--drop-shadow) rgb(var(--black-color) / 30%));
}
.promo-figure > img {
    width: calc(100% / 2 + 25%);
    margin: auto;
    display: block;
    z-index: 1;
    position: relative;
}
@keyframes bounce {
    0% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0); }
}
.workout-product_card > h5 {
    color: rgb(var( --color-green));
    font: 700 16px;
    margin-top: 1rem;
}
.workout-product_card > span {
    font: italic 400 14px;
    color: rgb(var(--black-color));
}
.workout-product_card img.img-fluid {
    filter: drop-shadow(5px 10px 8px rgb(var(--black-color) / 20%));
    max-width: 120px;
    margin: auto;
    display: block;
}
@media (max-width: 767px){
    .promo-container {grid-template-columns: 1fr;}
}
</style>
    {{-- Visitor Section End  --}}

    <!--============================
        LARGE BANNER  START
    ==============================-->
    @include('frontend.home.sections.large-banner')

    <!--============================
        LARGE BANNER  END
    ==============================-->

    {{-- Supliments Section  --}}
    <section class="home_supliments pt-5 pb-5">
    <div class="container">
        <div class="site-title text-center pb-4">
            <span class="small-title" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">Pushing limits, surpassing goals</span>
            <h3 data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50"><span>Proven excellence & quality manufacturing</span></h3>
        </div>

        <!-- Swiper Certification Slider -->
        <div class="swiper-container certification-slider">
            <div class="swiper-wrapper">
                <!-- Loop through dynamic certification images -->
                @foreach($certifications as $certification)
                    <div class="swiper-slide">
                        <img src="{{ asset('storage/' . $certification->image) }}" class="img-fluid" alt="Certification Image">
                    </div>
                @endforeach

                <!-- Add static images if there are fewer than 4 certifications -->
                @for($i = count($certifications); $i < 4; $i++)
                    <div class="swiper-slide">
                        <img src="{{ asset('frontend/images/static_image_' . ($i + 1) . '.png') }}" class="img-fluid" alt="Static Image">
                    </div>
                @endfor
            </div>
        </div>

        <!-- Swiper Script -->


    </div>
</section>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js" integrity="sha512-Ysw1DcK1P+uYLqprEAzNQJP+J4hTx4t/3X2nbVwszao8wD+9afLjBQYjz7Uk4ADP+Er++mJoScI42ueGtQOzEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Swiper JS Initialization -->
<script>
    // Initialize Swiper (this will work regardless of the number of images)
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        spaceBetween: 10,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        breakpoints: {
            500: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 4 }
        }
    });
</script>

<!-- Swiper Styles -->
<style>
    .swiper-container {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        width: 100%;
        max-width: 130px;
        min-width:130px;
        height: auto;
        /* display: block; */
        /* margin: auto; */
        filter: grayscale(0);
        transition: transform 0.3s ease;
    }

    .swiper-slide:hover img {
        transform: scale(1.15);
    }

    /* Pagination */
    .swiper-pagination {
        position: absolute;
        bottom: 10px;
        text-align: center;
        width: 100%;
    }

    .swiper-button-next, .swiper-button-prev {
        color: #000;  /* Change this color to match your design */
    }

    /* Responsive Styling */
    @media (max-width: 1024px) {
        .swiper-container {
            padding-left: 10px;
            padding-right: 10px;
        }
    }
</style>

    {{-- Supliments Section End  --}}
<style>
ul.home_supliments_aso {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    max-width: 1062px;
    margin: auto;
    grid-gap: 60px;
}
.home_supliments_aso li.aso_list {
    flex: 0 0 calc(100% / 5);
    max-width: calc(100% / 5);
}
.home_supliments_aso li.aso_list > img {
    filter: grayscale(0);
    width: 100%;
    max-width: 130px;
    transition: var(--transition);
    display: block;
    margin: auto;
    cursor: pointer;
}
.home_supliments_aso li.aso_list:hover > img {
    filter: grayscale(0);
    transform: scale(1.15);
    transition: var(--transition);
}
@media(max-width: 767px){
.home_supliments_aso li.aso_list {flex: 0 0 calc(100% / 3 - 7px);max-width: calc(100% / 3 - 7px);}
}
section.home_supliments, section.chairperson {
    box-shadow: inset 0px -7px 18px -15px rgb(var(--black-color) / 30%);
    padding: 3rem 0;
    position: relative;
    background: url('./frontend/images/bg-top-element.png'), url('./frontend/images/bg-bottom-element.png'), rgb(var(--color-white));
    background-repeat: no-repeat;
    background-position: top left, bottom right;
    background-size: 400px;
}
    </style>


    {{-- FAQ's Section  --}}
    <section class="home_faq pt-5 pb-5 mb-4">
        <div class="container">
            <div class="site-title text-center text-white pb-4">
                <span data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50" class="small-title">FAQ's</span>
                <h3 data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <span style="color: rgb(var(--color-green));">Your transformation journey begins here</span>
                </h3>
            </div>

            <div id="faq_accord">
                @if(!empty($faqArray))
                    <!-- Loop through dynamic FAQ content if available -->
                    @foreach($faqArray as $index => $faq)
                        <div class="faq_accord-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="accordion-button @if($index > 0) collapsed @endif"
                                 data-bs-toggle="collapse"
                                 data-bs-target="#collapse{{ $index }}"
                                 aria-expanded="false"
                                 aria-controls="collapse{{ $index }}">
                                {{ $faq['question'] }} <!-- Display FAQ question -->
                            </div>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse @if($index == 0) show @endif"
                                 aria-labelledby="heading{{ $index }}"
                                 data-bs-parent="#faq_accord">
                                <p>{{ $faq['answer'] }}</p> <!-- Display FAQ answer -->
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Static FAQ content in case of no dynamic data -->
                    <div class="faq_accord-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseStaticOne" aria-expanded="true" aria-controls="collapseStaticOne">
                            What is Jikaka's primary focus?
                        </div>
                        <div id="collapseStaticOne" class="accordion-collapse collapse show" aria-labelledby="headingStaticOne" data-bs-parent="#faq_accord">
                            <p>Jikaka focuses on value-added supply chain management for cumin and other organic commodities. They promote organic farming techniques, empowering farmers and ensuring the production of high-quality, pesticide-free products.</p>
                        </div>
                    </div>
                    <div class="faq_accord-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseStaticTwo" aria-expanded="false" aria-controls="collapseStaticTwo">
                            How does Jikaka support farmers?
                        </div>
                        <div id="collapseStaticTwo" class="accordion-collapse collapse" aria-labelledby="headingStaticTwo" data-bs-parent="#faq_accord">
                            <p>Jikaka provides training on organic farming practices, facilitates market access through the Maru Laxmi Women Cumin Farmers Producer Organization (FPO), and supports women farmers in producing their own organic inputs like herbal sprays and vermicompost.</p>
                        </div>
                    </div>
                    <div class="faq_accord-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseStaticThree" aria-expanded="false" aria-controls="collapseStaticThree">
                            What is the vision behind Jikaka?
                        </div>
                        <div id="collapseStaticThree" class="accordion-collapse collapse" aria-labelledby="headingStaticThree" data-bs-parent="#faq_accord">
                            <p>Jikaka aims to double farmers' income through sustainable organic farming practices, protect the environment by reducing chemical use, and improve human health by providing access to high-quality organic food.</p>
                        </div>
                    </div>
                    <div class="faq_accord-item" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseStaticFour" aria-expanded="false" aria-controls="collapseStaticFour">
                            How does Jikaka contribute to women's empowerment?
                        </div>
                        <div id="collapseStaticFour" class="accordion-collapse collapse" aria-labelledby="headingStaticFour" data-bs-parent="#faq_accord">
                            <p>Jikaka established the Maru Laxmi Women Cumin Farmers Producer Organization (FPO) to provide women farmers with better market opportunities and economic independence. The FPO empowers women by training them in organic farming techniques and enabling them to produce their own organic inputs.</p>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>

    {{-- FAQ's Section End  --}}
<style>
#faq_accord {
    max-width: 600px;
    margin-left: 0;
}
#faq_accord > .faq_accord-item .accordion-button {
    padding: 1rem 0;
    background-color: transparent !important;
    font: 400 24px !important;
    color: white !important;
    /* border-bottom: 1px solid rgb(var(--yellow-color) / 20% ) !important; */
    text-shadow: var(--text-shadow) rgb(var(--yellow-color) / 20%);
    border: none;
}
.accordion-collapse {
    padding: 1rem 0;
    font: 100 16px/24px ;
    color: rgb(var(--white-color));
}
</style>

    <!--============================
      HOME SERVICES START
    ==============================-->
    @include('frontend.home.sections.services')
    <!--============================
        HOME SERVICES END
    ==============================-->

    <!--============================
        HOME BLOGS START
    ==============================-->
    @include('frontend.home.sections.blog')
    <!--============================
        HOME BLOGS END
    ==============================-->


{{-- athlete slider  --}}

    {{-- <section class="athlete">
        <div class="container">
            <div class="site-title text-center text-white mt-5 pb-3">
                <h3 data-aos="fade-up"><span>Reward and Recognition</span></h3>
            </div>
            <div class="athleteSlide mt-4 mb-3">
                <div class="athleteSlide_item" data-aos="fade-left">
                    <img data-fancybox="gallery" src="{{ url('/') }}/frontend/images/certificate-01-new.jpg" alt="" width="" height="" class="img-fluid" />
                </div>
                <div class="athleteSlide_item" data-aos="fade-left">
                    <img data-fancybox="gallery" src="{{ url('/') }}/frontend/images/certificate-02-new.jpg" alt="" width="" height="" class="img-fluid" />
                </div>
            </div>
            <div class="text-center">
                <a class="athlete_btn" href="{{ route('gallery') }}">Know more</a>
            </div>
        </div>
    </section> --}}
    <style>

        /* main container */
        .image-container-main-header {
         display: block !important;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

        /* main container image  */
.athleteSlide_item {
    padding: 10px;
}
.athleteSlide_item >img{width: 100%}
.athleteSlide .slick-arrow {
    position: absolute;
    top: -40px;
    right: 10px;
    width: 40px;
    background-color: transparent;
    text-align: center;
    font-family: 'Font Awesome 5 Free';
    color: rgb(var(--red-color));
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0px;
    border: 1px solid rgb(var(--red-color));
    cursor: pointer;
    transition: var(--transition);
}
.athleteSlide .slick-arrow:hover{
    background-color: rgb(var(--red-color));
    color: rgb(var(--white-color));
}
.athleteSlide .slick-arrow.prv_arr {right: 60px;}


.category-section .container {
    text-align: center;
    margin: auto;
    display: flex;
}
.categoryList {
    margin: 1rem auto;
    text-align: center;
    display: flex;
    overflow: auto;
    /* justify-content: center; */
    grid-gap: 10px;
}
.categoryList>li>a, .categoryList>li>a>span {
    display: block;
    width: 100%;
    font: 400 13px / normal var(--font-three);
    margin-bottom: 10px;
    letter-spacing: 1px;
}
</style>

{{-- athlete slider End --}}




<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script>
Fancybox.bind('[data-fancybox="gallery"]', {
//
});
</script>

@endsection
