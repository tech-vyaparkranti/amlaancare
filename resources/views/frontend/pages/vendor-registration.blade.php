@extends('frontend.layouts.master3')

@section('title')
    {{ $settings->site_name ?? '' }} || Vendor Registration
@endsection

@section('content')
<!--============================
        BREADCRUMB START
    ==============================-->
<div class="breadcrumb">
    <div class="container-fluid">
        <ul class="m-0 p-0">
            <li><a href="{{ route('shop') }}">Home</a></li>
            <li><a href="#">Vendor Registration</a></li>
        </ul>
    </div>
</div>

<section class="vender-registration">
    <div class="container">
            <div class="registration-form">
                <div class="registration-title">
                    <h1>Welcome to the Vendor Partnership Program at Organic Jikaka</h1>
                    <p>Create Your Account to Start Selling</p>
                </div>
                <form action="{{ route('vendor-registration.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="businessName">Business Name</label>
                                <input type="text" class="form-control" id="shopName" name="business_name" placeholder="business name" required>
                            </div>
                        </div>
                        {{-- Grid 3 --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fullName">Full Name</label>
                                <input type="text" class="form-control" id="fullName" name="full_name" placeholder="full name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobileNumber">Mobile Number</label>
                                <input type="tel" class="form-control" id="mobileNumber" name="mobile_number" placeholder="mobile number" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="email address" required>
                            </div>
                        </div>
                        {{-- Grid 4 --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" id="country" name="country" placeholder="country" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="city" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="state">State/Province</label>
                                <input type="text" class="form-control" id="state" name="state" placeholder="state/province" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="postalCode">Postal/ZIP Code</label>
                                <input type="text" class="form-control" id="postalCode" name="postal_code" placeholder="postal code" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gstin">GSTIN</label>
                                <input type="text" class="form-control" id="gstin" name="gstin" placeholder="GSTIN number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="streetAddress">Street Address</label>
                                <input type="text" class="form-control" id="streetAddress" name="street_address" placeholder="street address" required>
                            </div>
                        </div>
                    </div>
                    <!-- Bank Account Details -->
                    <div class="row pt-4">
                        <div class="col-md-12">
                            <div class="registration-title">
                                <h3>Bank Details</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bankAccountName">Account Holder Name</label>
                                        <input type="text" class="form-control" id="bankAccountName" name="bank_account_name" placeholder="name on your bank account" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bankAccountNumber">Bank Account No.</label>
                                        <input type="text" class="form-control" id="bankAccountNumber" name="bank_account_number" placeholder="bank account number" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ifscCode">IFSC Code</label>
                                        <input type="text" class="form-control" id="ifscCode" name="ifsc_code" placeholder="IFSC code of your bank" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bankName">Bank Name</label>
                                        <input type="text" class="form-control" id="bankName" name="bank_name" placeholder="name of your bank" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="branch">Branch Name</label>
                                        <input type="text" class="form-control" id="branch" name="branch_name" placeholder="branch name" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- File Uploads -->
                            <div class="form-group">
                                <label for="cancelledCheque">Upload Cancelled Cheque</label>
                                <input type="file" class="form-control" id="cancelledCheque" name="cancelled_cheque" required>
                            </div>

                            <div class="form-group">
                                <label for="gstCertificate">Upload GST Certificate</label>
                                <input type="file" class="form-control" id="gstCertificate" name="gst_certificate" required>
                            </div>
                        </div>
                    </div>
                    <!-- Bank Account Details -->
                    <div class="row pt-4">
                        <div class="col-md-12">
                            <div class="registration-title">
                                <h3>Set Password</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Password -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Set your password" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- WhatsApp Consent -->
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="whatsappConsent" name="whatsapp_consent">
                                <label for="whatsappConsent">I want to receive important updates on WhatsApp</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-create-account mt-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</section>
{{-- <script>
    let mediaRecorder;
    let recordedChunks = [];
    let stream;  // To store the media stream
    let maxRecordingTime = 60; // Maximum recording time in seconds
    let recordingInterval; // For handling the countdown timer
    let elapsedTime = 0; // Track the time that has passed
    const videoPreview = document.getElementById('videoPreview');
    const startRecordingButton = document.getElementById('startRecording');
    const stopRecordingButton = document.getElementById('stopRecording');
    const reRecordButton = document.getElementById('reRecord');
    const videoBlobInput = document.getElementById('videoBlobInput');
    const timerDisplay = document.getElementById('timerDisplay');
    const capturedVideo = document.getElementById('capturedVideo');
    const reviewTitle = document.getElementById('reviewTitle');
    const submitVideoButton = document.getElementById('submitVideoButton');

    // Access the user's camera and microphone
    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            videoPreview.srcObject = stream; // Show live camera feed in the video element

            mediaRecorder = new MediaRecorder(stream);

            // Collect the recorded data chunks
            mediaRecorder.ondataavailable = (event) => {
                if (event.data.size > 0) {
                    recordedChunks.push(event.data); // Push recorded data chunks into the array
                }
            };

            // Handle when the recording stops
            mediaRecorder.onstop = () => {
                const videoBlob = new Blob(recordedChunks, { type: 'video/mp4' });
                recordedChunks = []; // Reset recorded chunks

                // Convert the Blob to a base64 string for form submission
                const reader = new FileReader();
                reader.readAsDataURL(videoBlob);
                reader.onloadend = function() {
                    videoBlobInput.value = reader.result; // Store base64 video in hidden input
                };

                // Create a video URL to show the recorded video in the review section
                const videoURL = URL.createObjectURL(videoBlob);
                capturedVideo.src = videoURL;
                capturedVideo.style.display = 'block'; // Show the captured video for review
                reviewTitle.style.display = 'block'; // Show the review title
                submitVideoButton.disabled = false; // Enable the submit button for form submission
            };
        } catch (err) {
            console.error('Error accessing camera: ', err);
            alert('Camera access is required to record a video.');
        }
    }

    // Start recording
    startRecordingButton.addEventListener('click', () => {
        if (mediaRecorder && mediaRecorder.state !== 'recording') {
            recordedChunks = []; // Clear any previous recordings
            mediaRecorder.start(); // Start recording
            startRecordingButton.disabled = true; // Disable start button
            stopRecordingButton.disabled = false; // Enable stop button
            reRecordButton.disabled = true; // Disable re-record button
            videoPreview.muted = true; // Mute live video during recording
            videoPreview.controls = false; // Disable controls while recording
            capturedVideo.style.display = 'none'; // Hide the previous review video
            reviewTitle.style.display = 'none'; // Hide the review title
            submitVideoButton.disabled = true; // Disable the submit button during new recording

            // Reset timer and start countdown
            elapsedTime = 0;
            updateTimerDisplay(); // Show initial 0 time
            recordingInterval = setInterval(() => {
                elapsedTime++;
                updateTimerDisplay();
                if (elapsedTime >= maxRecordingTime) {
                    stopRecording(); // Stop recording automatically after 60 seconds
                }
            }, 1000); // Increment every second
        }
    });

    // Stop recording (called manually or after time limit)
    stopRecordingButton.addEventListener('click', stopRecording);

    function stopRecording() {
        if (mediaRecorder && mediaRecorder.state === 'recording') {
            mediaRecorder.stop(); // Stop recording
            clearInterval(recordingInterval); // Clear the timer interval
            stream.getTracks().forEach(track => track.stop()); // Stop the camera stream
            startRecordingButton.disabled = true; // Keep start button disabled
            stopRecordingButton.disabled = true; // Disable stop button
            reRecordButton.disabled = false; // Enable re-record button
        }
    }

    // Re-record the video
    reRecordButton.addEventListener('click', () => {
        startCamera(); // Re-initialize the camera
        startRecordingButton.disabled = false; // Enable start button for new recording
        stopRecordingButton.disabled = true; // Disable stop button until recording starts
        reRecordButton.disabled = true; // Disable re-record button until recording stops
        videoPreview.controls = false; // Disable controls during re-recording
        videoPreview.muted = true; // Mute the video during re-recording
        timerDisplay.textContent = '00:00 / 01:00'; // Reset timer display
    });

    // Update the timer display
    function updateTimerDisplay() {
        const minutes = Math.floor(elapsedTime / 60).toString().padStart(2, '0');
        const seconds = (elapsedTime % 60).toString().padStart(2, '0');
        timerDisplay.textContent = `${minutes}:${seconds} / 01:00`;
    }

    // Initialize the camera feed when the page loads
    window.onload = startCamera;
</script>   --}}
{{-- <script>
    let mediaRecorder;
    let recordedChunks = [];
    let stream;
    let maxRecordingTime = 60;
    let recordingTimeout;
    let recordingInterval;
    let elapsedTime = 0;
    const videoPreview = document.getElementById('videoPreview');
    const startRecordingButton = document.getElementById('startRecording');
    const stopRecordingButton = document.getElementById('stopRecording');
    const reRecordButton = document.getElementById('reRecord');
    const videoBlobInput = document.getElementById('videoBlobInput');
    const timerDisplay = document.getElementById('timerDisplay');
    const capturedVideo = document.getElementById('capturedVideo');
    const reviewTitle = document.getElementById('reviewTitle');
    const submitVideoButton = document.getElementById('submitVideoButton');


    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
            videoPreview.srcObject = stream;
            mediaRecorder = new MediaRecorder(stream);


            mediaRecorder.ondataavailable = (event) => {
                if (event.data.size > 0) {
                    recordedChunks.push(event.data);
                }
            };


            mediaRecorder.onstop = () => {
                const videoBlob = new Blob(recordedChunks, { type: 'video/mp4' });
                recordedChunks = [];


                const reader = new FileReader();
                reader.readAsDataURL(videoBlob);
                reader.onloadend = function() {
                    videoBlobInput.value = reader.result;
                };


                const videoURL = URL.createObjectURL(videoBlob);
                capturedVideo.src = videoURL;
                capturedVideo.style.display = 'block';
                reviewTitle.style.display = 'block';
                submitVideoButton.disabled = false;
            };
        } catch (err) {
            console.error('Error accessing camera: ', err);
            alert('Camera access is required to record a video.');
        }


    startRecordingButton.addEventListener('click', () => {
        if (mediaRecorder && mediaRecorder.state !== 'recording') {
            recordedChunks = [];
            mediaRecorder.start();
            startRecordingButton.disabled = true;
            stopRecordingButton.disabled = false;
            reRecordButton.disabled = true;
            videoPreview.muted = true;
            videoPreview.controls = false;
            capturedVideo.style.display = 'none';
            reviewTitle.style.display = 'none';
            submitVideoButton.disabled = true;

            elapsedTime = 0;
            updateTimerDisplay();
            recordingInterval = setInterval(() => {
                elapsedTime++;
                updateTimerDisplay();
            }, 1000);


            recordingTimeout = setTimeout(stopRecording, maxRecordingTime * 1000);
        }


    stopRecordingButton.addEventListener('click', stopRecording);

    function stopRecording() {
        if (mediaRecorder && mediaRecorder.state === 'recording') {
            mediaRecorder.stop();
            clearInterval(recordingInterval);
            clearTimeout(recordingTimeout);
            stream.getTracks().forEach(track => track.stop());
            startRecordingButton.disabled = true;
            stopRecordingButton.disabled = true;
            reRecordButton.disabled = false;
        }


    reRecordButton.addEventListener('click', () => {
        startCamera();
        startRecordingButton.disabled = false;
        stopRecordingButton.disabled = true;
        reRecordButton.disabled = true;
        videoPreview.controls = false;
        videoPreview.muted = true;
        timerDisplay.textContent = '00:00 / 01:00';
    });


    function updateTimerDisplay() {
        const minutes = Math.floor(elapsedTime / 60).toString().padStart(2, '0');
        const seconds = (elapsedTime % 60).toString().padStart(2, '0');
        timerDisplay.textContent = `${minutes}:${seconds} / 01:00`;
    }


    window.onload = startCamera;
</script> --}}
@endsection
