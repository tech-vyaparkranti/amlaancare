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
                            <h4>Create Product Collection</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-collections.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Collection Name</label>
                                    <input type="text" class="form-control" name="collection_name" value="{{ old('collection_name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Collection Image</label>
                                    <input type="file" class="form-control" name="collection_image" value="{{ old('collection_image') }}" accept="image/*" required>
                                </div>
                                <div class="form-group">
                                    <label>Sort Number</label>
                                    <input type="number" min="1" class="form-control" name="sort_number" value="{{ old('sort_number') }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status" required>
                                        <option {{ old('status') == '1' ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ old('status') == '0' ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Text</label>
                                    <input type="text" class="form-control" name="text" required value="{{ old('text') }}">
                                </div>
                                <button type="submmit" class="btn btn-primary common_btn">Create</button>
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
        });
    </script>
@endpush
