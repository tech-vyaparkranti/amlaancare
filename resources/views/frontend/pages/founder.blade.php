@extends('frontend.layouts.master')

@section('title')
{{$settings->site_name??""}} || Team
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{route('home')}}">home</a></li>
                <li><a href="javascript:;">founder</a></li>
            </ul>
        </div>
    </div>
    <div class="founder">
        <div class="container">
            <div class="founder-section mt-3">
                <div class="founder-left-section">
                    <h4 >Meet Our Founder</h4>
                    <p class="text-justify mt-3 mb-3"><b>Dr. Deepika Ahlawat</b> Innovative and experienced Nutritionist with 14 years of expertise in conducting research, nutrition assessments and evaluating lifestyle factors. Working into Sports Authority with elite players of different discipline of India challenged and helped my expertise to expand a lot. Currently Entrepreneurial and creative Founder passionate about turning innovative ideas into tangible results. Formulated & developed one kit comprises 5 different ready to eat nutritious powerpack cookies {2 PREWORKOUT-1 MIDWORKOUT-2 POST WORKOUT }for 16+ young athletes, based on sports physiology and body mechanism. These are natural, any banned substance free , gluten free, , with zero chemical and preservatives. For this Government of India has chosen our project as innovative work and gave grants to extend. We are working hard for our young athletes to provide them best powerful natural and nutritious snacks to prevent them from health hazardous ill effects of synthetic -chemical powders and supplements. Delivering our kit PAN INDIA and getting tremendous results and currently working with NITI AYOG -UN FAO Program's.</p>
                    {{-- <div class="qualificatons">
                        <div class="qualification-section">
                            <i class="fas fa-trophy-alt"></i><span><b> Experience so far:</b></span>
                            <p>FOUNDER & DIRECTOR NUCO EXPERT PRIVATE LIMITED</p>
                            <p>SPORTS NUTRITIONIST - BOXING FEDARATION OF INDIA</p>
                            <p>SPORTS NUTRITIONIST - SPORTS AUTHORITY OF INDIA</p>
                            <p>SPORTS NUTRITIONIST - SPORTS AUTHORITY OF INDIA</p>
                        </div>
                        <div class="qualification-section">
                            <i class="fas fa-graduation-cap"></i><span><b> Education: </b></span>
                            <p><b>Associate of Science:</b> SPORTS AND EXERCISE NUTRITIO - MASTER PROGRAMME IN SPORTS AND EXERCISE NUTRITION - PUNE MAHARASHTRA</p>
                            <p><b>Ph.D:</b> FOODS AND NUTRITION - CHAUDHARY CHARAN SINGH HARYANA AGRICULTURE UNIV - HISAR HARYANA</p>
                            <p><b>Master of Science:</b> FOODS AND NUTRITION - CHAUDHARY CHARAN SINGH HARYANA AGRICULTURE UNIV - HISAR HARAYANA</p>
                            <p><b>Bachelor of Science:</b> FOODS AND NUTRITION - CHAUDHARY CHARAN SINGH HARYANA AGRICULTURE UNIV - HISAR HARYANA</p>
                        </div>
                    </div> --}}
                </div>
                <div class="founder-right-section">
                    <img src="./frontend/images/about-profile.jpg" alt="" class="img-fluid">
                </div>
            </div>
            <div class="qualificatons">
                <div class="qualification-section mt-3">
                    <i class="fas fa-trophy-alt"></i><span><b> Experience so far:</b></span>
                    <p>FOUNDER & DIRECTOR NUCO EXPERT PRIVATE LIMITED</p>
                    <p>SPORTS NUTRITIONIST - BOXING FEDARATION OF INDIA</p>
                    <p>SPORTS NUTRITIONIST - SPORTS AUTHORITY OF INDIA</p>
                    <p>SPORTS NUTRITIONIST - SPORTS AUTHORITY OF INDIA</p>
                </div>
                <div class="qualification-section">
                    <i class="fas fa-graduation-cap"></i><span><b> Education: </b></span>
                    <p><b>Associate of Science:</b> SPORTS AND EXERCISE NUTRITIO - MASTER PROGRAMME IN SPORTS AND EXERCISE NUTRITION - PUNE MAHARASHTRA</p>
                    <p><b>Ph.D:</b> FOODS AND NUTRITION - CHAUDHARY CHARAN SINGH HARYANA AGRICULTURE UNIV - HISAR HARYANA</p>
                    <p><b>Master of Science:</b> FOODS AND NUTRITION - CHAUDHARY CHARAN SINGH HARYANA AGRICULTURE UNIV - HISAR HARAYANA</p>
                    <p><b>Bachelor of Science:</b> FOODS AND NUTRITION - CHAUDHARY CHARAN SINGH HARYANA AGRICULTURE UNIV - HISAR HARYANA</p>
                </div>
            </div>
        </div>
    </div>
<style>
    .founder-section{
    display: flex;
    justify-content: space-between;
    grid-gap: 15px;
}
.founder-left-section{
    flex:0 0 60%;
}
.founder-right-section{
    flex:0 0 40%;
}
.founder-left-section p {
    font: 500 15px/26px var(--font-three);
    text-align: justify;
}
.qualificatons{
    display: flex;
    justify-content: space-between;
    grid-gap: 30px;
}
/* .qualification-section{
    flex: 0 0 50%;
} */
.qualification-section p {
    margin: 0px;
    font-size: 14px;
    color: grey;
    font-style: italic;
    text-align: justify;
}
.qualification-section i {
    border: 1px solid black;
    font-size: 30px;
    padding: 10px;
    border-radius: 50%;
    line-height: 40px;
    text-align: center;
    height: 60px;
    width: 60px;
    background-color: black;
    color: #fff;
}
@media(max-width:500px){
    .founder-section{
    display: block;
}
    .qualificatons{
    display: block;
}

}
</style>
@endsection
