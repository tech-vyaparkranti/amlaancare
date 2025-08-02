@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
        </div>
            @if (session()->has('message'))
                <div class="alert alert-warning">
                    {{ session('message') }}
                </div>
            @endif
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Image <b>(D:300px X 380px)</b></label>
                                    <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="categoryId">Category</label>
                                            <select id="categoryId" class="form-control main-category" name="category">
                                                <option value="">Select</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Sub Category</label>
                                            <select id="inputState" class="form-control sub-category" name="sub_category">
                                                <option value="">Select</option>
                                                {{-- @foreach ($subCategories as $subCategory)
                                                    <option
                                                       
                                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputState">Child Category</label>
                                            <select id="inputState" class="form-control child-category" name="child_category">
                                                <option value="">Select</option>
                                                {{-- @foreach ($childCategories as $childCategory)
                                                <option
                                                    value="{{ $childCategory->id }}">{{ $childCategory->name }}
                                                </option>
                                            @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Brand</label>
                                        <select id="inputState" class="form-control" name="brand">
                                            <option value="">Select</option>
                                            @foreach ($brands as $brand)
                                                <option {{ old('brand') == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <label>Select Product Fonts</label>
                                    <div class="row">
                                        @if (!empty($fonts))
                                            @foreach ($fonts as $item)
                                                <div class="col-md-2">
                                                    <label>Font Name : {{ $item->font_name }}</label>
                                                    <div class="custom-control custom-checkbox image-checkbox border-right">
                                                        <input type="checkbox" class="custom-control-input" name="product_font[]" id="font_image_{{ $item->id }}" value="{{ $item->id }}">
                                                        <label class="custom-control-label" for="font_image_{{ $item->id }}">
                                                            <img src="{{ asset($item->font_sample_image) }}" alt="{{ $item->font_name }}" class="img-fluid w-50">
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Select Product Color Samples</label>
                                    <div class="row">
                                        @if (!empty($colours))
                                            @foreach ($colours as $item)
                                                <div class="col-md-2">
                                                    <label>Colour Name : {{ $item->colour_name }}</label>
                                                    <div class="custom-control custom-checkbox image-checkbox border-right">
                                                        <input type="checkbox" class="custom-control-input" name="product_colour[]" id="colour_image_{{ $item->id }}" value="{{ $item->id }}">
                                                        <label class="custom-control-label" for="colour_image_{{ $item->id }}">
                                                            <img src="{{ asset($item->colour_sample_image) }}" alt="{{ $item->colour_name }}" class="img-fluid w-50">
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div> --}}

                                <!-- New Fields: Length, Breadth, Height, Weight, HSN Code -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Length (cm)</label>
                                        <input type="text" class="form-control" name="length" value="{{ old('length') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Breadth (cm)</label>
                                        <input type="text" class="form-control" name="breadth" value="{{ old('breadth') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Height (cm)</label>
                                        <input type="text" class="form-control" name="height" value="{{ old('height') }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Weight (kg)</label>
                                        <input type="text" class="form-control" name="weight" value="{{ old('weight') }}">
                                    </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <label>HSN Code</label>
                                    <input type="text" class="form-control" name="hsn_code" value="{{ old('hsn_code') }}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Product Certificate (PDF)</label>
                                    <input type="file" class="form-control" name="product_certificate" accept="application/pdf">
                                </div>
                            </div>

                                <!-- Rest of the existing fields -->
                                <div class="form-group">
                                    <label>SKU</label>
                                    <input type="text" class="form-control" name="sku" value="{{ old('sku') }}">
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                </div>

                                <div class="form-group">
                                    <label>Offer Price</label>
                                    <input type="text" class="form-control" name="offer_price" value="{{ old('offer_price') }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Offer Start Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_start_date" value="{{ old('offer_start_date') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Offer End Date</label>
                                            <input type="text" class="form-control datepicker" name="offer_end_date" value="{{ old('offer_end_date') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Stock Quantity</label>
                                    <input type="number" min="0" class="form-control" name="qty" value="{{ old('qty') }}">
                                </div>

                                <div class="form-group">
                                    <label>Video Link</label>
                                    <input type="text" class="form-control" name="video_link" value="{{ old('video_link') }}">
                                </div>

                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control">{{ old('short_description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Long Description</label>
                                    <textarea name="long_description" class="form-control summernote">{{ old('long_description') }}</textarea>
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

                                <div class="form-group">
                                    <label>Seo Title</label>
                                    <input type="text" class="form-control" name="seo_title" value="{{ old('seo_title') }}">
                                </div>

                                <div class="form-group">
                                    <label>Seo Description</label>
                                    <textarea name="seo_description" class="form-control">{{ old('seo_description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ old('status') == '1' ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ old('status') == '0' ? 'selected' : '' }} value="0">Inactive</option>
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
    </section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
            let category = "{{ old('image') }}";
            if (category) {
                $("#categoryId").val(category).trigger("change");
            }
            $('body').on('change', '.main-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-subcategories') }}",
                    data: { id: id },
                    success: function(data) {
                        $('.sub-category').html('<option value="">Select</option>');
                        $.each(data, function(i, item) {
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`);
                        });
                        let subCategory = '{{ old('sub_category') }}';
                        if (subCategory) {
                            $('.sub-category').val(subCategory).trigger("change");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });

            $('body').on('change', '.sub-category', function(e) {
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-child-categories') }}",
                    data: { id: id },
                    success: function(data) {
                        $('.child-category').html('<option value="">Select</option>');
                        $.each(data, function(i, item) {
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`);
                        });
                        let childCategory = '{{ old('child_category') }}';
                        if (childCategory) {
                            $('.child-category').val(childCategory).trigger("change");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>


@endpush
