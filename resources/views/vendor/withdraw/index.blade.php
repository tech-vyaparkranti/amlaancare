@extends('vendor.layouts.master')

@section('title')
{{$settings->site_name??""}} || Withdraw
@endsection

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">

            <h3><i class="far fa-user"></i> All Withdraw</h3>
            <div class="dashboard">
                <div class="row">

                    <div class="col-xl-4 col-6 col-md-4 mb-4">
                        <a class="dashboard_item" href="{{route('vendor.orders.index')}}">
                            <div class="dashboard_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M4,11c-2.21,0-4,1.79-4,4v5c0,2.21,1.79,4,4,4h4.26c2.8,0,5.48-1.18,7.37-3.25l7.7-8.41c.95-1.06,.86-2.71-.19-3.66-.51-.47-1.19-.71-1.88-.68-.7,.03-1.34,.33-1.79,.83l-3.54,3.74c.03,.21,.06,.42,.06,.64,0,2.08-1.55,3.88-3.62,4.17l-4.25,.6c-.55,.08-1.05-.3-1.13-.85-.08-.55,.3-1.05,.85-1.13l4.16-.58c.94-.13,1.75-.81,1.94-1.73,.3-1.43-.79-2.69-2.16-2.69H4Z"/><path d="M9.81,4.79l-3.29-.55c-.3-.05-.52-.31-.52-.62,0-.34,.28-.62,.62-.62h2.64c.36,0,.69,.19,.87,.5,.28,.48,.89,.64,1.37,.36,.48-.28,.64-.89,.37-1.37-.54-.92-1.53-1.5-2.6-1.5h-.27c0-.55-.45-1-1-1s-1,.45-1,1h-.38c-1.45,0-2.62,1.18-2.62,2.62,0,1.29,.92,2.38,2.19,2.59l3.29,.55c.3,.05,.52,.31,.52,.62,0,.34-.28,.62-.62,.62h-2.64c-.36,0-.69-.19-.87-.5-.28-.48-.89-.64-1.37-.36-.48,.28-.64,.89-.37,1.37,.54,.92,1.53,1.5,2.6,1.5h.27c0,.55,.45,1,1,1s1-.45,1-1h.38c1.45,0,2.62-1.18,2.62-2.62,0-1.29-.92-2.38-2.19-2.59Z"/></svg>
                            </div>
                            <div class="dashboard_details">
                                <span>{{ $settings->currency_icon }}{{ $currentBalance }}</span>
                                <p>Current Balance</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-6 col-md-4 mb-4">
                        <a class="dashboard_item" href="{{route('vendor.orders.index')}}">
                            <div class="dashboard_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="m22,12h2c0,6.617-5.383,12-12,12S0,18.617,0,12,5.383,0,12,0v2C6.486,2,2,6.486,2,12s4.486,10,10,10,10-4.486,10-10Zm-11-6v1c-1.654,0-3,1.346-3,3,0,1.359.974,2.51,2.315,2.733l3.04.506c.374.062.645.382.645.761,0,.552-.448,1-1,1h-2c-.552,0-1-.448-1-1h-2c0,1.654,1.346,3,3,3v1h2v-1c1.654,0,3-1.346,3-3,0-1.359-.974-2.51-2.315-2.733l-3.04-.506c-.374-.062-.645-.382-.645-.761,0-.552.448-1,1-1h2c.552,0,1,.448,1,1h2c0-1.654-1.346-3-3-3v-1h-2ZM22,0h-5v2h3.586l-4.293,4.293,1.414,1.414,4.293-4.293v3.586h2V2c0-1.103-.897-2-2-2Z"/></svg>
                            </div>
                            <div class="dashboard_details">
                                <span>{{ $settings->currency_icon }}{{ $pendingAmount }}</span>
                                <p>Pending Amount</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-6 col-md-4 mb-4">
                        <a class="dashboard_item" href="{{route('vendor.orders.index')}}">
                            <div class="dashboard_icon">
                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 24 24"><path d="M15.74,3c.48,.6,.88,1.27,1.18,2h4.08v3h-3.5c0,4.41-3.59,8-8,8h-.83l9.57,8h-4.69L3,15.23v-2.23h6.5c2.76,0,5-2.24,5-5H3v-3H13.5c-.91-1.21-2.37-2-4-2H3V0H21V3h-5.26Z"/></svg>
                            </div>
                            <div class="dashboard_details">
                                <span>{{ $settings->currency_icon }}{{ $totalWithdraw }}</span>
                                <p>Total Withdraw</p>
                            </div>
                        </a>
                    </div>


                    {{-- <div class="col-md-4">
                        <a class="dashboard_item red" href="{{route('vendor.orders.index')}}">
                          <i class="fas fa-cart-plus"></i>
                          <p>Current Balance</p>
                          <h4 style="color:#ffff">{{ $settings->currency_icon }}{{ $currentBalance }}</h4>
                        </a>
                      </div> --}}
{{--
                      <div class="col-md-4">
                        <a class="dashboard_item red" href="{{route('vendor.orders.index')}}">
                          <i class="fas fa-cart-plus"></i>
                          <p>Pending Amount</p>
                          <h4 style="color:#ffff">{{ $settings->currency_icon }}{{ $pendingAmount }}</h4>
                        </a>
                      </div> --}}

                      {{-- <div class="col-md-4">
                        <a class="dashboard_item red" href="{{route('vendor.orders.index')}}">
                          <i class="fas fa-cart-plus"></i>
                          <p>Total Withdraw</p>
                          <h4 style="color:#ffff">{{ $settings->currency_icon }}{{ $totalWithdraw }}</h4>
                        </a>
                      </div> --}}
                </div>
            </div>
            <div class="create_button">
                <a href="{{route('vendor.withdraw.create')}}" class="btn btn-primary common_btn"><i class="fas fa-plus"></i> Create Request</a>
            </div>
            <div class="dashboard_profile">
              <div class="dash_pro_area">
                {{ $dataTable->table() }}
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

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
