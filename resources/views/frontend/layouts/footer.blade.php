@php
    $footerInfo = Cache::rememberForever('footer_info', function(){
            return \App\Models\FooterInfo::first();
    });
    $footerSocials = Cache::rememberForever('footer_socials', function(){
        return \App\Models\FooterSocial::where('status', 1)->get();
    });
    $footerGridTwoLinks = Cache::rememberForever('footer_grid_two', function(){
        return \App\Models\FooterGridTwo::where('status', 1)->get();
    });
    $footerMenuLinks = Cache::rememberForever('footer_menu', function(){
        return \App\Models\FooterMenu::where('status', 1)->get();
    });
    $footerTitle = \App\Models\FooterTitle::first();
    $footerGridThreeLinks = Cache::rememberForever('footer_grid_three', function(){
        return \App\Models\FooterGridThree::where('status', 1)->get();
    });
    $footerSocials = \App\Models\FooterSocial::where('status', 1)->get();
@endphp
<footer class="footer_2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-2 col-sm-6 col-md-4 col-lg-3">
                <div class="footer_content"> 
                    {{-- <h5>Address</h5> --}}
                    {{-- <h5>Venuses</h5> --}}
                    <a class="footer_2_logo" href="{{url('/')}}">
                        <img src="{{asset(@$footerInfo->logo)}}" alt="logo">
                    </a>
                    <p>{{@$footerInfo->address}}</p>
                    <a class="action" href="tell:{{@$footerInfo->phone}}">Contact : {{@$footerInfo->phone}}</a>
                    <a class="action" href="mailto:{{@$footerInfo->email}}">E-mail ID : {{@$footerInfo->email}}</a>  
                    {{-- <ul class="footer_social">
                        @foreach ($footerSocials as $link)
                        <li><a href="{{$link->url}}"><i class="{{$link->icon}}"></i></a></li>
                        @endforeach
                    </ul> --}}
                    {{-- <div class="footer_content">
                        <h5>Venuses</h5>
                        <ul class="footer_menu">
                                <li><a href="{{ route('about') }}"><i class="fas fa-caret-right"></i> About us</a></li>
                                <li><a href="{{ url('/') }}"><i class="fas fa-caret-right"></i> Blog</a></li>
                                <li><a href="{{ url('/') }}"><i class="fas fa-caret-right"></i> Media</a></li>
                                <li><a href="{{ route('bulkOrder') }}"><i class="fas fa-caret-right"></i> Bulk Order</a></li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            <div class="col-xl-2 col-sm-6 col-md-4 col-lg-2">
                <div class="footer_content">
                    @if($footerTitle)
    <h5>{{ $footerTitle->footer_menu_title }}</h5>
@else
    <h5>Menu</h5> {{-- fallback title --}}
@endif
                    <ul class="footer_menu">
                        @foreach ($footerMenuLinks as $link)
                            <li><a href="{{$link->url}}"><i class="fas fa-caret-right"></i> {{$link->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-6 col-md-4 col-lg-2">
                <div class="footer_content">
@if($footerTitle)
    <h5>{{ $footerTitle->footer_grid_two_title }}</h5>
@endif                    <ul class="footer_menu">
                        @foreach ($footerGridTwoLinks as $link)
                            <li><a href="{{$link->url}}"><i class="fas fa-caret-right"></i> {{$link->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="footer_content">
                    @if($footerTitle)
                    <h5>{{$footerTitle->footer_grid_three_title}}</h5>
                    @endif 
                    <ul class="footer_menu">
                        @foreach ($footerGridThreeLinks as $link)
                            <li><a href="{{$link->url}}"><i class="fas fa-caret-right"></i> {{$link->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-sm-7 col-md-8 col-lg-5">
                <div class="footer_content footer_content_2">
                    <h5>Newsletter</h5>
                    <p>Get all the latest information on Events, Sales and Offers. Get all the latest information on Events.</p>
                    <form action="" method="POST" id="newsletter">
                        @csrf
                        <input type="text" placeholder="Email" name="email" class="newsletter_email">
                        <button type="submit" class="common_btn subscribe_btn"><i class="fa-solid fa-arrow-right"></i></button>
                        {{-- <label for="captcha_answer" style="font-size: 14px; white-space: nowrap;">
                            What is <span id="num1" style="font-weight: bold;"></span> + <span id="num2" style="font-weight: bold;"></span>?
                        </label>
                        <input type="number" id="captcha_answer" name="captcha_answer"
                                placeholder="Answer" required
                                style="width: 90px; padding: 5px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px;">
                            <input type="hidden" id="correct_captcha" name="correct_captcha"> --}}

                    </form>

                    {{-- <form action="" method="POST" id="newsletter" style="max-width: 400px; margin: 0 auto;">
                        @csrf
                        <input type="text" placeholder="Email" name="email" class="newsletter_email" required
                            style="width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ccc; border-radius: 5px;">

                        <!-- Basic Math Captcha -->
                        <div class="captcha-wrapper" style="display: flex; align-items: center; gap: 8px; margin-bottom: 15px;">
                            <label for="captcha_answer" style="font-size: 14px; white-space: nowrap;">
                                What is <span id="num1" style="font-weight: bold;"></span> + <span id="num2" style="font-weight: bold;"></span>?
                            </label>
                            <input type="number" id="captcha_answer" name="captcha_answer"
                                placeholder="Answer" required
                                style="width: 60px; padding: 5px; border: 1px solid #ccc; border-radius: 5px;">
                            <input type="hidden" id="correct_captcha" name="correct_captcha">
                        </div>

                        <button type="submit" class="common_btn subscribe_btn"
                            style="background-color: #f36f36; color: white; border: none; padding: 10px 15px; border-radius: 5px; cursor: pointer;">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </form> --}}

                    <script>
                        // Generate two random numbers for captcha
                        const num1 = Math.floor(Math.random() * 10) + 1;
                        const num2 = Math.floor(Math.random() * 10) + 1;

                        document.getElementById('num1').innerText = num1;
                        document.getElementById('num2').innerText = num2;

                        // Store the correct answer in a hidden field
                        document.getElementById('correct_captcha').value = num1 + num2;

                        // Optional: add client-side validation
                        document.getElementById('newsletter').onsubmit = function (e) {
                            const userAnswer = document.getElementById('captcha_answer').value;
                            const correctAnswer = document.getElementById('correct_captcha').value;
                            if (parseInt(userAnswer) !== parseInt(correctAnswer)) {
                                alert('Captcha answer is incorrect. Please try again.');
                                e.preventDefault();
                            }
                        };
                    </script>




                </div>
            </div>
        </div>
        {{-- <div class="footer-bottom">
            <div class="footerBottom_left">
                <div class="footerLanguage footer_content">
                    <h5>Download About Us</h5>
                    <!-- Button to open the form -->
                    <button id="showFormButton" class="btn btn-secondary">Download About Us</button>

                    <!-- Form to collect name and phone -->
                    <div id="formSection" style="display: none;">
                        <form id="downloadForm">
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" id="phone" name="phone" class="form-control" placeholder="Phone number" required>
                            </div>
                            <button type="button" id="downloadButton" class="btn btn-success" disabled>Download</button>
                        </form>

                    </div>
                </div>
            </div>

            <div class="footerBottom_right">
                <div class="footer_payment footer_content ">
                    <h5>We're using safe payment for :</h5>
                    <ul>
                        <li><img src="{{asset('frontend/images/card_1.png')}}" alt="card" class="img-fluid"></li>
                        <li><img src="{{asset('frontend/images/card_2.png')}}" alt="card" class="img-fluid"></li>
                        <li><img src="{{asset('frontend/images/card_3.png')}}" alt="card" class="img-fluid"></li>
                        <li><img src="{{asset('frontend/images/card_4.png')}}" alt="card" class="img-fluid"></li>
                        <li><img src="{{asset('frontend/images/card_5.png')}}" alt="card" class="img-fluid"></li>
                        <li><img src="{{asset('frontend/images/card_6.png')}}" alt="card" class="img-fluid"></li>
                        <li><img src="{{asset('frontend/images/card_7.png')}}" alt="card" class="img-fluid"></li>
                    </ul>
                </div>
            </div>
        </div> --}}
        <div class="footerSocial">
            <h5>Follow Us:</h5>
            <div class="social-icons">
                @foreach ($footerSocials as $social)
                    <a href="{{ $social->url }}" target="_blank" class="social-icon">
                        <i class="{{ $social->icon }}"></i>
                    </a>
                @endforeach
            </div>
        </div>

    </div>

    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="copyright d-flex justify-content-center">
                        <p>{{@$footerInfo->copyright}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<style>
/* Social Media Icons Styling */
.footerSocial {
    margin-top: 30px;
    text-align: center;
}

.footerSocial h5 {
    font-size: 18px;
    margin-bottom: 15px;
    color: white; /* Optional: set text color to white */
}
button#showFormButton {
    background: rgb(var(--color-header)/85%);
}
.social-icons {
    display: flex;
    justify-content: center;
    gap: 60px; /* Adjust the space between icons */
}

.social-icons .social-icon {
    font-size: 30px; /* Adjust icon size */
    color: white; /* Set icon color to white */
    text-decoration: none; /* Remove underlines */
    transition: color 0.3s ease; /* Smooth transition for hover effect */
}

.social-icons .social-icon:hover {
    color: white; /* Change to your preferred hover color */
}


</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
   document.addEventListener('DOMContentLoaded', function() {
    // Get elements
    const showFormButton = document.getElementById('showFormButton');
    const formSection = document.getElementById('formSection');
    const downloadButton = document.getElementById('downloadButton');
    const nameInput = document.getElementById('name');
    const phoneInput = document.getElementById('phone');

    // Show the form when the button is clicked
    showFormButton.addEventListener('click', function() {
        formSection.style.display = 'block';
        showFormButton.style.display = 'none'; // Hide the download button
    });

    // Enable the download button when both fields are filled
    [nameInput, phoneInput].forEach(input => {
        input.addEventListener('input', function() {
            if (nameInput.value && phoneInput.value) {
                downloadButton.disabled = false;
            } else {
                downloadButton.disabled = true;
            }
        });
    });

    // Handle PDF download when the download button is clicked
    downloadButton.addEventListener('click', function() {
        // The URL of your PDF file (it can be a local file or a URL)
        const pdfUrl = '{{ asset('uploads/Organic_Jikaka_Profile.pdf') }}';

        // Create an anchor element to trigger the download
        const a = document.createElement('a');
        a.href = pdfUrl;
        a.download = 'About-Us.pdf';  // This will be the name of the file when downloaded
        a.click();  // Trigger the download
    });
});

</script>

