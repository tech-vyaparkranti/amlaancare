<section id="banner">
    <div class="banner_content">
        <div class="banner_slider">
            {{-- <img src="https://dummyimage.com/1920x650/cfcfcf/363636.png" class="img-fluid" alt="Anydany" /> --}}
            @foreach ($sliders as $slider)
                <div class="mainSingle_slider">
                    <a href="{{$slider->btn_url}}" class="d-block">
                        <img src="{{$slider->banner}}" srcset="{{$slider->banner}}, {{$slider->banner}}, {{$slider->mobile_banner}} 767w" class="img-fluid" alt="e-commerce" />
                        {{-- <img src="{{$slider->mobile_banner}}" class="img-fluid" alt="e-commerce" /> --}}
                    </a>
                    {{-- <div class="single_slider_text">
                        <h3>{!! $slider->type !!}</h3>
                        <h1>{!! $slider->title !!}</h1>
                        <h6>start at {{$settings->currency_icon ?? ''}}{{$slider->starting_price}}</h6>
                        <a class="common_btn" href="{{$slider->btn_url}}">shop now</a>
                    </div> --}}
                </div>
            @endforeach
        </div>
    </div>
</section>
