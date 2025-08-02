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
                <li><a href="javascript:;">team</a></li>
            </ul>
        </div>
    </div>
<div class="team-outer-box">
    <div class="site-title text-center pb-4 mt-3">
        <h3><b>Meet</b><span> Our Team</span></h3>
    </div>
    <div class="container team-container">
        <div class="team-inner-box">
            <div class="team-card mt-3">
                <img src="./frontend/images/team-1.jpg" alt="team-img" >
                <div class="team-about">
                <h5>Dr. Deepti Ahlawat </h5>
                <p><b>(Ph.D : FOODS AND NUTRITION )</b></p>
                <span>Founder, Director & CEO</span>
                </div>
            </div>
            <div class="team-card mt-3">
                <img src="./frontend/images/team-1.jpg" alt="team-img" >
                <div class="team-about">
                <h5>Mr. Ankit </h5>
                <p><b>(MBA Marketing & HR Expert)</b></p>
                <span>13 Years Of Experience in Marketing ,  Sales & Resourcing</span>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="team-outer-box mt-5">
    <div class="site-title text-center pb-4 mt-3">
        <h3><span> Our Inspiration</span></h3>
    </div>
    <div class="container team-container">
        <div class="team-inner-box">
            <div class="team-card mt-3 inspiration">
                <img src="./frontend/images/op.jpg" alt="team-img" >
                <div class="team-about">
                <h5>O.P Ahlawat -  Ex-Indian Navy </h5>
                <p><b>CO-FOUNDER & DIRECTOR</b></p>
                <span>28 Years Of Experience in
                    Logistic  Handling &
                     Management Of Supplying  Goods
                    </span>
                </div>
            </div>
            <div class="team-card mt-3 inspiration">
                <img src="./frontend/images/dk.png" alt="team-img" >
                <div class="team-about">
                <h5>Dr.DK Sharma,Scientist </h5>
                <p><b>ADVISOR & MENTOR</b></p>
                <span>Chaudhary Charan Singh  Haryana Agriculture University –Hisar- Haryana</span>
            </div>
            </div>
            <div class="team-card mt-3 inspiration">
                <img src="./frontend/images/deepak.jpg" alt="team-img" >
                <div class="team-about">
                <h5>Cdr Deepak(Retd)-IRON MAN  </h5>
                <p><b>ADVISOR & MENTOR</b></p>
                <span>M.Tech(IIT-Delhi)
                    Served Indian Navy For 21 Years
                    </span>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="site-title text-center pb-4 mt-3">
        <h3><span>Certifications</span></h3>
    </div>
    <div class="certificate-container">
        <div class="certificates mt-3">
            <img src="./frontend/images/certificate-1.jpg" alt="certificate">
            <p class="mt-2">Outstanding Innovator Award-In Food Processing Sector – SUFALAM-2024 MOFPI {NIFTEM-K}</p>
        </div>
        <div class="certificates mt-3">
            <img src="./frontend/images/certificate-2.jpg" alt="certificate">
            <p class="mt-2">Honorary Award For Exemplary Work Rendered In The Field Of Health And Nutrition On  International Women’s Day :- Om Sterling Global University 8th March 2022.</p>
        </div>
    </div>
</div>
<style>

.team-inner-box {
    display: flex;
    grid-gap: 20px;
    justify-content: center;
}
.team-card {
    background-color: rgb(var(--white-color));
    max-width: 350px;
    overflow: hidden;
    height: auto;
    box-shadow: var(--box-shadow);
}
.team-card img {
    max-width: 100%;
    min-width:100% ;
    max-height: 330px;
    min-height: 330px;
}
.team-about {
    padding: 14px;
}
.inspiration{
    flex:0 0 33%;
}
.team-about span {
    font-size: 15px;
    font-weight: 400;
    color: rgb(var(--black-color));
    line-height: 27px;
    font-family: var(--font-one);
    font-style: italic;
}
.team-about p {
    font: 400 13px/35px var(--font-two);
}
.team-about h5 {
    font: 500 20px/normal var(--font-one);
    color: rgb(var(--gold-color));
}
.certificate-container{
    display: flex;
    grid-gap: 10px;
    justify-content: center;
}
.certificate-container .certificates{
    flex: 0 0 calc(100% /2 - 5px);
}
.certificate-container .certificates img{
    max-height: 350px;
    box-shadow: var(--box-shadow);
    max-width: 100%;
}
.certificates p{
    font-size: 15px;
    font-weight: 400;
    color: rgb(var(--gold-color));
    line-height: 27px;
    font-family: var(--font-one);
    font-style: italic;
}
@media(max-width:500px){
    .team-inner-box{
        display: block;
    }
    .certificate-container .certificates{
    flex: 0 0 100%;
}
.certificate-container{
    display: block;
}
}
</style>
@endsection
