@extends('vendor.layouts.master')

@section('title')
{{$settings->site_name??""}} || Product
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
            <h3><i class="far fa-user"></i> Create Product</h3>
            <div class="dashboard_profile">
              <div class="dash_pro_area">
                <form action="{{route('vendor.products.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group input">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="form-group input">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group input">
                                <label for="inputState">Category</label>
                                <select id="inputState" class="form-control main-category" name="category">
                                  <option value="">Select</option>
                                  @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group input">
                                <label for="inputState">Sub Category</label>
                                <select id="inputState" class="form-control sub-category" name="sub_category">
                                    <option value="">Select</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group input">
                                <label for="inputState">Child Category</label>
                                <select id="inputState" class="form-control child-category" name="child_category">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group input">
                        <label for="inputState">Brand</label>
                        <select id="inputState" class="form-control" name="brand">
                            <option value="">Select</option>
                            @foreach ($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group input">
                        <label>SKU</label>
                        <input type="text" class="form-control" name="sku" value="{{old('sku')}}">
                    </div>

                    <div class="form-group input">
                        <label>Price</label>
                        <input type="text" class="form-control" name="price" value="{{old('price')}}">
                    </div>

                    <div class="form-group input">
                        <label>Offer Price</label>
                        <input type="text" class="form-control" name="offer_price" value="{{old('offer_price')}}">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group input">
                                <label>Offer Start Date</label>
                                <input type="text" class="form-control datepicker" name="offer_start_date" value="{{old('offer_start_date')}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group input">
                                <label>Offer End Date</label>
                                <input type="text" class="form-control datepicker" name="offer_end_date" value="{{old('offer_end_date')}}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group input">
                        <label>Stock Quantity</label>
                        <input type="number" min="0" class="form-control" name="qty" value="{{old('qty')}}">
                    </div>

                    <div class="form-group input">
                        <label>Video Link</label>
                        <input type="text" class="form-control" name="video_link" value="{{old('video_link')}}">
                    </div>

                    <div class="form-group input">
                        <label>Short Description</label>
                        <textarea name="short_description" class="form-control"></textarea>
                    </div>

                    <div class="form-group input">
                        <label>Long Description</label>
                        <textarea name="long_description" class="form-control summernote"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="inputState">Product Type</label>
                        <select id="inputState" class="form-control" name="product_type">
                            <option value="">Select</option>
                            <option {{ old('product_type') == 'new_arrival' ? 'selected' : '' }} value="new_arrival">New Arrival</option>
                            {{-- <option {{ old('product_type') == 'featured_product' ? 'selected' : '' }} value="featured_product">Featured</option>
                            <option {{ old('product_type') == 'top_product' ? 'selected' : '' }} value="top_product">Top Product</option>
                            <option {{ old('product_type') == 'best_product' ? 'selected' : '' }} value="best_product">Best Product</option> --}}
                            <option {{ old('product_type') == 'latest_product' ? 'selected' : '' }} value="latest_product">Latest Product</option>
                            <option {{ old('product_type') == 'best_seller_product' ? 'selected' : '' }} value="best_seller_product">Best Seller Product</option>
                        </select>
                    </div>

                    <div class="form-group input">
                        <label>Seo Title</label>
                        <input type="text" class="form-control" name="seo_title" value="{{old('seo_title')}}">
                    </div>

                    <div class="form-group input">
                        <label>Seo Description</label>
                        <textarea name="seo_description" class="form-control"></textarea>
                    </div>

                    <!-- New fields for Length, Breadth, Height, Weight, and HSN Code -->
                    <div class="form-group input">
                        <label>Length (cm)</label>
                        <input type="text" class="form-control" name="length" value="{{old('length')}}">
                    </div>

                    <div class="form-group input">
                        <label>Breadth (cm)</label>
                        <input type="text" class="form-control" name="breadth" value="{{old('breadth')}}">
                    </div>

                    <div class="form-group input">
                        <label>Height (cm)</label>
                        <input type="text" class="form-control" name="height" value="{{old('height')}}">
                    </div>

                    <div class="form-group input">
                        <label>Weight (kg)</label>
                        <input type="text" class="form-control" name="weight" value="{{old('weight')}}">
                    </div>

                    <div class="form-group input">
                        <label>HSN Code</label>
                        <input type="text" class="form-control" name="hsn_code" value="{{old('hsn_code')}}">
                    </div>
                    <div class="form-group input">
                        <label>Product Certificate (PDF)</label>
                        <input type="file" class="form-control" name="product_certificate" accept="application/pdf">
                    </div>

                    <div class="form-group input">
                        <label for="inputState">Status</label>
                        <select id="inputState" class="form-control" name="status">
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tracing location From</label>
                        <input type="text" class="form-control" name="from_address" value="{{ old('from_address') }}" required>
                        <label>Tracing location To</label>
                        <input type="text" class="form-control" name="to_address" value="{{ old('to_address') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary common_btn">Create</button>
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

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('vendor.product.get-subcategories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.sub-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })

            /** get child categories **/
            $('body').on('change', '.sub-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('vendor.product.get-child-categories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.child-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item){
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
