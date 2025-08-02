<section id="blogs" class="home_blogs">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_header">
                    <h3>recent blogs</h3>
                    <a class="see_btn" href="{{route('blog')}}">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row home_blog_slider">
            @foreach ($recentBlogs as $blog)
            <?php // echo '<pre>', print_r($blog),'</pre>'; die(); ?>
            <div class="col-xl-3" >
                <div class="single_blog single_blog_2"  style="box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);">
                    <p class="single_blog_date">{{date('M D Y', strtotime($blog->created_at))}}</p>
                    <a class="blog_img" href="{{route('blog-details', $blog->slug)}}"><img src="{{asset($blog->image)}}" alt="blog" class="img-fluid w-100"></a>
                    <div class="blog_text">
                        <div class="blog_text_center">
                            <a class="blog-title" href="{{route('blog-details', $blog->slug)}}">{!!limitText($blog->title, 45)!!}</a>
                            <a class="blog_category_name" href="#">{{$blog->category->name}}</a>
                            <div class="blog_description">{!!limitText($blog->description, 200)!!}</div>
                            <a class="read-more" href="{{route('blog-details', $blog->slug)}}">read more</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
