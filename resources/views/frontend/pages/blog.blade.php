@extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name ?? ''}} || About
@endsection

@section('content')

    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('shop') }}">Home</a></li>
                <li><a href="#">blogs</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        BLOGS PAGE START
    ==============================-->
    <section id="blogs">
        <div class="container">
           @if (request()->has('search'))
           <h5>Search: {{request()->search}}</h5>
           <hr>
           @elseif (request()->has('category'))
           <h5>Search: {{request()->category}}</h5>
           <hr>
           @endif
            <div class="row">
                @foreach ($blogs as $blog)
                <div class="col-xl-3">
                    <div class="single_blog single_blog_2">
                        <a class="blog_img" href="{{route('blog-details', $blog->slug)}}">
                            <img src="{{asset($blog->image)}}" alt="blog" class="img-fluid w-100">
                        </a>
                        <div class="blog_text">
                            <a class="blog_top red" href="#">{{$blog->category->name}}</a>
                            <div class="blog_text_center">
                                <a href="{{route('blog-details', $blog->slug)}}">{!!limitText($blog->title, 45)!!}</a>
                                <p class="date">{{date('M D Y', strtotime($blog->created_at))}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            @if (count($blogs) === 0)
            <div class="row">
                <div class="card">
                    <div class="card-body text-center">
                        <h3>Sorry No Blog Found!</h3>
                    </div>
                </div>
            </div>
            @endif
            <div id="pagination">
                <div class="mt-5">
                    @if ($blogs->hasPages())
                        {{$blogs->withQueryString()->links()}}
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BLOGS PAGE END
    ==============================-->
@endsection
