@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Collection Product</h1>
          </div>
          <div class="mb-3">
            <a href="{{route('admin.product-collections.index')}}" class="btn btn-primary common_btn">Back</a>
          </div>
          <div class="section-body">

            <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h4>Collection Name: {{ $productCollection->collection_name }}</h4>
                      </div>
                      <div class="card-body">
                          <form action="{{ route('admin.product-collections-manage.store') }}" method="POST"
                               >
                              @csrf
                              <div class="form-group">
                                  <label for="">Select Product</label>
                                  <select name="products[]" multiple required class="select2 form-control" id="products">

                                    @foreach ($products as $item )
                                      <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                    @endforeach
                                  </select>
                                  <input type="hidden" name="collection_id" value="{{ $productCollection->id }}">
                              </div>
                              <button type="submit" class="btn btn-primary common_btn">Add Products</button>
                          </form>
                      </div>

                  </div>
              </div>
          </div>

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">

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

    <script>
        $(document).ready(function(){
            $('body').on('click', '.change-status', function(){
                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{route('admin.product-collections.change-status')}}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data){
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })

            })
        })
    </script>
@endpush
