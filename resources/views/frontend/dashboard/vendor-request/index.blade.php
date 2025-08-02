@extends('frontend.dashboard.layouts.master')

@section('title')
{{$settings->site_name??""}} || Became a Vendor Today
@endsection

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="dashboard">
    <div class="container-fluid">
        @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i> Vendor Request</h3>
            <div class="dashboard_profile">
              <div class="dash_pro_area">
                {!!@$content->content!!}
              </div>
            </div>
            <br>
            <div class="dashboard_profile">
                <div class="dash_pro_area">
                    <form action="{{route('user.vendor-request.create')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="businessName">Business Name</label>
                                    <input disabled type="text" class="form-control" id="shopName" name="business_name" placeholder="business name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input disabled type="text" class="form-control" id="fullName" name="full_name" placeholder="full name" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobileNumber">Mobile Number</label>
                                    <input disabled type="tel" class="form-control" id="mobileNumber" name="mobile_number" placeholder="mobile number" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input disabled type="email" class="form-control" id="email" name="email" placeholder="email address" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <input disabled type="text" class="form-control" id="country" name="country" placeholder="country" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input disabled type="text" class="form-control" id="city" name="city" placeholder="city" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="state">State/Province</label>
                                    <input disabled type="text" class="form-control" id="state" name="state" placeholder="state/province" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="postalCode">Postal/ZIP Code</label>
                                    <input disabled type="text" class="form-control" id="postalCode" name="postal_code" placeholder="postal code" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gstin">GSTIN</label>
                                    <input disabled type="text" class="form-control" id="gstin" name="gstin" placeholder="GSTIN number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetAddress">Street Address</label>
                                    <input disabled type="text" class="form-control" id="streetAddress" name="street_address" placeholder="street address" required>
                                </div>
                            </div>
                        </div>
                        <!-- Bank Account Details --
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
                                            <input disabled type="text" class="form-control" id="bankAccountName" name="bank_account_name" placeholder="name on your bank account" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bankAccountNumber">Bank Account No.</label>
                                            <input disabled type="text" class="form-control" id="bankAccountNumber" name="bank_account_number" placeholder="bank account number" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ifscCode">IFSC Code</label>
                                            <input disabled type="text" class="form-control" id="ifscCode" name="ifsc_code" placeholder="IFSC code of your bank" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bankName">Bank Name</label>
                                            <input disabled type="text" class="form-control" id="bankName" name="bank_name" placeholder="name of your bank" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="branch">Branch Name</label>
                                            <input disabled type="text" class="form-control" id="branch" name="branch_name" placeholder="branch name" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cancelledCheque">Upload Cancelled Cheque</label>
                                    <input disabled type="file" class="form-control" id="cancelledCheque" name="cancelled_cheque" required>
                                </div>

                                <div class="form-group">
                                    <label for="gstCertificate">Upload GST Certificate</label>
                                    <input disabled type="file" class="form-control" id="gstCertificate" name="gst_certificate" required>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-4">
                            <div class="col-md-12">
                                <div class="registration-title">
                                    <h3>Set Password</h3>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input disabled type="password" class="form-control" id="password" name="password" placeholder="Set your password" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input disabled type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm your password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input disabled type="checkbox" class="form-check-input" id="whatsappConsent" name="whatsapp_consent">
                                    <label for="whatsappConsent">I want to receive important updates on WhatsApp</label>
                                </div>
                                <button type="submit" disabled class="btn-create-account common_btn mt-3">Submit</button>
                            </div>
                        </div> <br><br> --}}








                        <div class="form-group">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <input type="file" name="shop_image" placeholder="Shop Banner Image">
                        </div>
                        <div class="form-group">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <input type="text" name="shop_name" placeholder="Shop Name">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <i class="fas fa-user-tie" aria-hidden="true"></i>
                                    <input type="text" name="shop_email" placeholder="Shop Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <i class="fas fa-user-tie" aria-hidden="true"></i>
                                    <input type="text" name="shop_phone" placeholder="Shop Phone">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <i class="fas fa-user-tie" aria-hidden="true"></i>
                            <input type="text" name="shop_address" placeholder="Shop Address">
                        </div>

                        <div class="form-group">
                            <textarea name="about" placeholder="About You"></textarea>
                        </div>

                        <button type="submit" class="common_btn mb-4 mt-2">Submit</button>

                    </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection

