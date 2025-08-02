@extends('frontend.layouts.master2')

@section('title')
    {{$settings->site_name ?? ''}} || Batch Tracking
@endsection

@section('content')
    <!--============================ BREADCRUMB START ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a>Batch Tracking</a></li>
            </ul>
        </div>
    </div>
    <!--============================ BREADCRUMB END ==============================-->


    <!--============================ TRACKING BATCH START ==============================-->
    <section id="login_register" class="pt-5">
        <div class="container">
            <div class="track_area">
                <div class="row">
                    <div class="col-xl-5 col-md-10 col-lg-8 m-auto">
                        <!-- Batch Tracking Form -->
                        <form class="tack_form" action="{{ route('trackBatch') }}" method="GET">
                            <h4 class="text-center">Batch Tracking</h4>
                            <p class="text-center">Track the details of your batch</p>
                            <div class="track_input">
                                <label class="d-block mb-2">Batch Number*</label>
                                <input type="text" placeholder="BATCH123" name="batch_number" value="{{ old('batch_number') }}">
                            </div>
                            <button type="submit" class="common_btn">Track</button>
                        </form>
                    </div>
                </div>

                <!-- Track Batch Details -->
                @if (isset($batchDetails))
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="track_header">
                                <div class="track_header_text">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="track_header_single">
                                                <h5>Batch Number</h5>
                                                <p>{{ $batchDetails['batch_number'] ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="track_header_single">
                                                <h5>Batch Name</h5>
                                                <p>{{ $batchDetails['batch_name'] ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="track_header_single">
                                                <h5>Start Date</h5>
                                                <p>{{ date('d M Y', strtotime($batchDetails['start_date'])) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- PDF Download -->
                        <div class="col-xl-12 mt-4">
                            @if (isset($batchDetails['pdf_url']))
                            <a href="{{ asset('storage/' . $batchDetails['pdf_url']) }}" download class="common_btn">Download PDF</a>                            {{-- <script>
                                    document.getElementById('downloadBtn').addEventListener('click', function(e) {
                                        e.preventDefault();

                                        // Get the dynamic URL for the PDF from Blade
                                        var pdfUrl = "{{ asset('storage/uploads/batches/' . $batchDetails['pdf_url']) }}"; // Correct path

                                        // Check if the pdfUrl is available
                                        if (!pdfUrl) {
                                            alert('No PDF available for this batch!');
                                            return;
                                        }

                                        // Create an invisible anchor tag to trigger the download
                                        var link = document.createElement('a');
                                        link.href = pdfUrl;
                                        link.download = pdfUrl.split('/').pop();  // Extract the filename with extension

                                        // Programmatically click the link to start the download
                                        link.click();
                                    });
                                </script> --}}
                            @else
                                <p>No PDF available for this batch.</p>
                            @endif
                        </div>
                        
                        
                        

                        <!-- Back Button -->
                        <div class="col-xl-12 mt-4">
                            <a href="{{ url('/') }}" class="common_btn"><i class="fas fa-chevron-left"></i> Back to Home</a>
                        </div>
                    </div>
                @endif

                <!-- Error Message -->
                @if (isset($errorMessage))
                    <div class="alert alert-danger">
                        {{ $errorMessage }}
                    </div>
                @endif
            </div>
        </div>
    </section>
    
    <!--============================ TRACKING BATCH END ==============================-->
@endsection
