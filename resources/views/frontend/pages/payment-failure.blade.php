{{-- @extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name??""}} || Payment
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('shop') }}">Home</a></li>
                <li><a href="javascript:;">payment</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="cart_view">
        <div class="container">
            <div class="pay_info_area">
                <div class="row" style="display: flex; justify-content: center; margin-top: 20px;">

                    <div class="payment-box" id="payment-failed">

                        <h1 style="font-size: 24px;   font-family: Arial, sans-serif; color: black; display: flex; align-items: center; gap: 10px; margin: 0;">
                            <i class="fas fa-times-circle" style="font-size: 24px; color: black;"></i>
                            Payment Failed! {{ $message ?? "" }}
                        </h1>

                    </div>

                    <!-- Add Font Awesome CDN in your HTML head if not already included -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">



                </div>


            </div>



        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->

    <style>
  .pay_info_area {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 30vh;
    padding: 20px;
}

.payment-box {
    max-width: 500px;
    width: 100%;
    height: 200px; /* Set a fixed height */
    background: whitesmoke;
    color: black;
    padding: 20px 30px;
    border-radius: 0px;
    border: 2px solid black;
    font-weight: bold;
    font-size: 20px;
    text-align: center;
    opacity: 0;
    transform: translateY(50px);
    animation: fadeIn 1s forwards, shake 0.5s 1s;
    box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);

    /* Center content vertically and horizontally */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* Optional: if you want to style the text itself inside */
.payment-box h1 {
    margin: 0;
    font-size: 24px;
    display: flex;
    align-items: center;
    gap: 10px; /* Space between icon and text */
    text-align: center;
}

/* Keyframes for fade and shake */
@keyframes fadeIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes shake {
    0% { transform: translateX(-5px); }
    25% { transform: translateX(5px); }
    50% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
    100% { transform: translateX(0); }
}

/* Responsive - Tablet */
@media (max-width: 768px) {
    .payment-box {
        max-width: 90%;
        height: 180px; /* Slightly smaller height for smaller screens */
        padding: 15px 20px;
        font-size: 18px;
    }
}

/* Responsive - Mobile */
@media (max-width: 480px) {
    .payment-box {
        max-width: 95%;
        height: 160px; /* Even smaller height for very small screens */
        padding: 12px 15px;
        font-size: 16px;
    }
}



    </style>



    <script>

function showPaymentFailedPopup(message = "Transaction could not be processed.") {
    const modal = document.getElementById("payment-failed-modal");
    const messageSpan = document.getElementById("payment-message");

    messageSpan.textContent = message;
    modal.style.display = "block";

    document.querySelector(".close").onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
}


setTimeout(() => {
    showPaymentFailedPopup("Unable to complete transaction.");
}, 1000);

  </script>


@endsection --}}


{{-- new update 13/06 start --}}

@extends('frontend.layouts.master3')

@section('title')
{{$settings->site_name??""}} || Payment
@endsection

@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <div class="breadcrumb">
        <div class="container-fluid">
            <ul class="m-0 p-0">
                <li><a href="{{ route('shop') }}">Home</a></li>
                <li><a href="javascript:;">payment</a></li>
            </ul>
        </div>
    </div>
    <!--============================
        BREADCRUMB END
    ==============================-->

    <!--============================
        PAYMENT PAGE START
    ==============================-->
    <section id="cart_view">
        <div class="container">
            <div class="pay_info_area">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10">
                        <!-- Payment Status Card -->
                        <div class="payment-status-card" id="payment-failed">
                            <div class="status-header">
                                <div class="status-icon">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                                <h2 class="status-title">Payment Failed</h2>
                                <p class="status-message">{{ $message ?? "We're sorry, but your payment could not be processed at this time." }}</p>
                            </div>
                        </div>

                        <!-- Order Details Card -->


                        <!-- Action Buttons -->
                        <div class="action-buttons">
                            {{-- <button class="btn btn-retry" onclick="retryPayment()">
                                <i class="fas fa-redo"></i> Try Again
                            </button> --}}
                            <a href="{{ route('shop') }}" class="btn btn-continue">
                                <i class="fas fa-shopping-cart"></i> Continue Shopping
                            </a>
                            {{-- <button class="btn btn-support" onclick="contactSupport()">
                                <i class="fas fa-headset"></i> Contact Support
                            </button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        PAYMENT PAGE END
    ==============================-->

    <!-- Add Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .pay_info_area {
            padding: 40px 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 80vh;
        }

        .payment-status-card {
            background: #fff;
            border-radius: 16px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            border-left: 6px solid #e74c3c;
            opacity: 0;
            transform: translateY(30px);
            animation: slideInUp 0.8s forwards;
        }

        .status-icon {
            font-size: 64px;
            color: #e74c3c;
            margin-bottom: 20px;
            animation: shake 0.6s ease-in-out;
        }

        .status-title {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .status-message {
            font-size: 16px;
            color: #7f8c8d;
            line-height: 1.6;
            max-width: 500px;
            margin: 0 auto;
        }

        .order-details-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            opacity: 0;
            transform: translateY(30px);
            animation: slideInUp 0.8s 0.2s forwards;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px 30px;
            border-bottom: none;
        }

        .card-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-body {
            padding: 30px;
        }

        .order-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-item .label {
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .info-item .value {
            font-size: 16px;
            color: #2c3e50;
            font-weight: 600;
        }

        .order-items h4 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 10px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #ecf0f1;
        }

        .item:last-child {
            border-bottom: none;
        }

        .item-details {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .item-name {
            font-weight: 600;
            color: #2c3e50;
        }

        .item-qty {
            font-size: 14px;
            color: #7f8c8d;
        }

        .item-price {
            font-weight: 700;
            color: #27ae60;
            font-size: 16px;
        }

        .order-total {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 12px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .total-row.final-total {
            border-top: 2px solid #ecf0f1;
            padding-top: 15px;
            margin-top: 15px;
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
            opacity: 0;
            transform: translateY(30px);
            animation: slideInUp 0.8s 0.4s forwards;
        }

        .btn {
            padding: 15px 25px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-width: 160px;
            justify-content: center;
        }

        .btn-retry {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }

        .btn-retry:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }

        .btn-continue {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-continue:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.4);
            text-decoration: none;
            color: white;
        }

        .btn-support {
            background: linear-gradient(135deg, #95a5a6 0%, #7f8c8d 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(149, 165, 166, 0.3);
        }

        .btn-support:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(149, 165, 166, 0.4);
        }

        @keyframes slideInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-8px); }
            20%, 40%, 60%, 80% { transform: translateX(8px); }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .pay_info_area {
                padding: 20px 0;
            }

            .payment-status-card {
                padding: 30px 20px;
                margin-bottom: 20px;
            }

            .status-icon {
                font-size: 48px;
            }

            .status-title {
                font-size: 24px;
            }

            .card-body {
                padding: 20px;
            }

            .order-info-grid {
                grid-template-columns: 1fr;
                gap: 15px;
                padding: 15px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 280px;
            }
        }

        @media (max-width: 480px) {
            .status-title {
                font-size: 20px;
            }

            .status-message {
                font-size: 14px;
            }

            .card-header {
                padding: 15px 20px;
            }

            .card-header h3 {
                font-size: 18px;
            }
        }
    </style>

    <script>
     function contactSupport() {
            // Add your contact support logic here
            window.location.href = '{{ route("contact") ?? "#" }}';
        }
    </script>

    {{-- <script>
        function showPaymentFailedPopup(message = "Transaction could not be processed.") {
            const modal = document.getElementById("payment-failed-modal");
            const messageSpan = document.getElementById("payment-message");

            messageSpan.textContent = message;
            modal.style.display = "block";

            document.querySelector(".close").onclick = function () {
                modal.style.display = "none";
            };

            window.onclick = function (event) {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            };
        }

        function retryPayment() {
            // Add your retry payment logic here
            window.location.href = '{{ route("checkout") ?? "#" }}';
        }

        function contactSupport() {
            // Add your contact support logic here
            window.location.href = '{{ route("contact") ?? "#" }}';
        }

        setTimeout(() => {
            showPaymentFailedPopup("Unable to complete transaction.");
        }, 1000);
    </script> --}}
@endsection
