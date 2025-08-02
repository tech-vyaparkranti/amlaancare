
@php
    // Fetch the latest enabled HomePageDetail
    $latestHomeDetail = \App\Models\HomePageDetail::where('status', 'enabled')->latest()->first();
    
    // Assuming 'slider_images' is a JSON column, where multiple images are stored
    $sliderImages = $latestHomeDetail ? json_decode($latestHomeDetail->slider_images) : [];
@endphp
<section id="banner">
    {{-- <div class="banner_content">
        <div class="banner_slider">
            @foreach ($sliders as $slider) --}}
                {{-- <div class="single_slider" style="background: url({{$slider->banner}});"> --}}
                    {{-- <img src="{{$slider->banner}}" class="img-fluid" alt="anydany's" /> --}}
                    {{-- <div class="single_slider_text">
                        <h3>{!! $slider->type !!}</h3>
                        <h1>{!! $slider->title !!}</h1>
                        <h6>start at {{$settings->currency_icon}}{{$slider->starting_price}}</h6>
                        <a class="common_btn" href="{{$slider->btn_url}}">shop now</a>
                    </div> --}}
                {{-- </div> --}}
            {{-- @endforeach
        </div> --}}
        <div class="videoSection">
            <video autoplay muted loop playsinline preload="metadata" class="desktop-video">
                <source src="./frontend/video/Banner video jikaka (2).mp4" type="video/mp4">
            </video>
            <video autoplay muted loop playsinline preload="metadata" hidden class="mobile-video d-none">
                <source src="./frontend/video/Banner video jikaka (Mobile Video).mp4" type="video/mp4">
            </video>
        </div>
        {{-- <div class="videoSection">
            @php
                // Fetch the latest enabled HomePageDetail with video
                $latestHomeDetail = \App\Models\HomePageDetail::where('status', 'enabled')->latest()->first();
            @endphp
            <!-- Desktop Video -->
            @if($latestHomeDetail && $latestHomeDetail->desktop_video)
                <video autoplay muted loop playsinline preload="metadata" class="desktop-video">
                    <source src="{{ asset('storage/' . $latestHomeDetail->desktop_video) }}" type="video/mp4">
                </video>
            @endif
            <!-- Mobile Video -->
            @if($latestHomeDetail && $latestHomeDetail->mobile_video)
                <video autoplay muted loop playsinline preload="metadata" hidden class="mobile-video d-none">
                    <source src="{{ asset('storage/' . $latestHomeDetail->mobile_video) }}" type="video/mp4">
                </video>
            @endif
        </div> --}}
    
    </div>
</section>
<style>
 
 video.mobile-video, video.desktop-video {
    object-fit: cover;
    /* position: absolute; */
    max-height: 646px;
    min-height: 646px;
    /* height: 630px; */
    width: 100%;
}
@media (max-width: 767px) {
    video.desktop-video {
        display: none;
    }
    .mobile-video{display: block !important;}
}
</style>