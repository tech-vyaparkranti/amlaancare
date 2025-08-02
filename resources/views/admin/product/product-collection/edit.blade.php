@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product Collection</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Product Collection</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-collections.update', $productCollection->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Collection Name</label>
                                    <input type="text" class="form-control" name="collection_name" required value="{{ old('collection_name',$productCollection->collection_name) }}">
                                </div>
                                <div class="form-group">
                                    <label>Preview</label>
                                    <br>
                                    <img src="{{ asset($productCollection->collection_image) }}" style="width:200px" alt="">
                                </div>
                                <div class="form-group">
                                    <label>Collection Image</label>
                                    <input type="file" class="form-control" name="collection_image" accept="image/*" >
                                </div>
                                <div class="form-group">
                                    <label>Sort Number</label>
                                    <input type="number" min="1" class="form-control" name="sort_number" value="{{ old('sort_number',$productCollection->sort_number) }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status" required>
                                        <option {{ old('status',$productCollection->status) == '1' ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ old('status',$productCollection->status) == '0' ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Text</label>
                                    <input type="text" class="form-control" name="text" required value="{{ old('text',$productCollection->text) }}">
                                </div>
                                <button type="submmit" class="btn btn-primary common_btn">Update</button>
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

        })
    </script>
@endpush
