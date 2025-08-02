
<section id="single_banner" class="single_banner_2 mt-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 mb-4">
                @if (!empty($homepage_secion_banner_two->banner_one->status) && $homepage_secion_banner_two->banner_one->status == 1)
                <div class="single_banner_content">
                    <a href="{{$homepage_secion_banner_two->banner_one->banner_url}}">
                        <img class="img-gluid" src="{{asset($homepage_secion_banner_two->banner_one->banner_image)}}" alt="">
                    </a>
                </div>
                @endif
            </div>
            <div class="col-xl-6 col-lg-6 mb-4">
                @if (!empty($homepage_secion_banner_two->banner_two->status) && $homepage_secion_banner_two->banner_two->status == 1)
                <div class="single_banner_content">
                    <a href="{{$homepage_secion_banner_two->banner_two->banner_url}}">
                        <img class="img-gluid" src="{{asset($homepage_secion_banner_two->banner_two->banner_image)}}" alt="">
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
