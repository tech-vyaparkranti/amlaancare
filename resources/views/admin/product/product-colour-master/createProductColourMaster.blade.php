@extends('admin.layouts.master')
@section('title',"Product Colour Master")
@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Product Colour Master</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Product Colour Master Entry</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product-colour-master.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Colour Name</label>
                                    <input type="text" class="form-control" name="colour_name" value="{{ old('colour_name') }}">
                                </div>

                                <div class="form-group">
                                    <label>Colour Sample Image</label>
                                    <input type="file" class="form-control" name="colour_sample_image" value="{{ old('colour_sample_image') }}">
                                </div>
                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ old('status') == '1' ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ old('status') == '0' ? 'selected' : '' }} value="0">Inactive</option>
                                    </select>
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
