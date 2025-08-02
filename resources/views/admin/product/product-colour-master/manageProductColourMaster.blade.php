@extends('admin.layouts.master')
@section('title',"Product Colour Master")
@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Colour Master</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>All Product Colours</h4>
                    <div class="card-header-action">
                        <a href="{{route('admin.product-colour-master.create')}}" class="btn btn-primary common_btn"><i class="fas fa-plus"></i> Create New</a>
                    </div>
                  </div>
                  <div class="card-body">
                    {{ $dataTable->table() }}
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
