@extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name??""}} || Login
@endsection

@section('content')

    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#">login / register</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->

    <!--============================
       LOGIN/REGISTER PAGE START
    ==============================-->
    <section id="login_register" class="pt-5">
        <div class="container-fluid">
            {{-- <div class="row">
                <div class="col-xl-5 m-auto"> --}}
                    <div class="login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist" style="flex-wrap: nowrap";>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                    aria-selected="true">login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-profiles" type="button" role="tab"
                                    aria-controls="pills-profiles" aria-selected="true">signup</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                aria-labelledby="pills-home-tab2">
                                <h4>Login Account</h4>
                                <div class="login">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="login_input">
                                            <i class="fas fa-phone"></i>
                                            <input id="phone" type="text" value="{{old('phone')}}" name="phone" placeholder="Phone">
                                        </div>
                                        {{-- <div class="login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input id="email" type="email" value="{{old('email')}}" name="email" placeholder="Email">
                                        </div> --}}

                                        <div class="login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" type="password" name="password" placeholder="Password">
                                        </div>


                                        <div class="login_save">
                                            <div class="form-check form-switch">
                                                <input id="remember_me" name="remember" class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Remember
                                                    me</label>
                                            </div>
                                            <a class="forget_p" href="{{ route('password.request') }}">forget password ?</a>
                                        </div>

                                        <button class="common_btn" type="submit">login</button>
                                        {{-- <p class="social_text">Sign in with social account</p>
                                        <ul class="login_link">
                                            <li><a href="#"><i class="fab fa-google"></i></a></li>
                                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                        </ul> --}}
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                aria-labelledby="pills-profile-tab2">
                                <h4>Signup Account</h4>
                                <div class="login">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input id="name" name="name" value="{{old('name')}}" type="text" placeholder="Name">
                                        </div>
                                        <div class="login_input">
                                            <i class="fas fa-phone"></i>
                                            <input id="phone" name="phone" value="{{old('phone')}}" type="text" placeholder="Phone">
                                        </div>

                                        <div class="login_input">
                                            <i class="far fa-envelope"></i>
                                            <input id="email" type="email" name="email" value="{{old('email')}}" type="text" placeholder="Email">
                                        </div>


                                        <div class="login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" name="password" type="password" placeholder="Password">
                                        </div>


                                        <div class="login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password">
                                        </div>

                                        <button class="common_btn mt-4" type="submit">signup</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- </div>
            </div> --}}
        </div>
    </section>
    <!--============================
       LOGIN/REGISTER PAGE END
    ==============================-->
@endsection
