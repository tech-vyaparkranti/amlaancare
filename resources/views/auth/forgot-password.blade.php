@extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name ?? ''}} || Forgot Password
@endsection

@section('content')

    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('home') }}/login">Login</a></li>
                <li><a href="#">Forget password</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->
    


    <!--============================
        FORGET PASSWORD START
    ==============================-->
    <section id="login_register" class="pt-5">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="forget_area">
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <h4>forget password ?</h4>
                        <p>enter the email address to register with <span>e-shop</span></p>
                        <div class="login">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input id="email" type="email" name="email" value="{{old('email')}}" placeholder="Your Email">
                                </div>

                                <button class="common_btn" type="submit">send</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{route('login')}}">go to login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        FORGET PASSWORD END
    ==============================-->
@endsection
