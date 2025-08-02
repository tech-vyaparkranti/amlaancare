<section id="large_banner" class="home_Production">
    @if (!empty($homepage_secion_banner_four) && $homepage_secion_banner_four->banner_one->status == 1)
        <a class="d-block" href="{{$homepage_secion_banner_four->banner_one->banner_url}}">
            <img style="width: 100%" class="img-fluid w-100" src="{{asset($homepage_secion_banner_four->banner_one->banner_image)}}" alt="">
        </a>
    @endif
</section>