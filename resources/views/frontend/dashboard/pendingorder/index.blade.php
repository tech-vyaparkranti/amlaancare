@extends('frontend.dashboard.layouts.master')

@section('title')
{{$settings->site_name ?? ""}} || Orders
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
            <h3><i class="far fa-user"></i> Orders</h3>
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
    DASHBOARD END
  ==============================-->
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

