@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1>Category</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- <div class="form-group">
                                <label>Icon</label>
                                <div>
                                    <button class="btn btn-primary common_btn" data-icon="{{ $category->icon }}" data-selected-class="btn-danger"
                                            data-unselected-class="btn-info" role="iconpicker" name="icon"></button>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label>Category Image <b>( D:1420px X 350px )</b></label>
                                <input type="file" class="form-control" name="category_banner" accept="image/*">

                               <img src="{{ asset('storage/' . $category->category_banner) }}" alt="Current Image" style="width: 100px; height: auto; margin-top: 10px;">

                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Min Quantity</label>
                                <input type="text" class="form-control" name="min_quantity" value="{{ $category->min_quantity }}">
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option {{ $category->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $category->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*">

                               <img src="{{ asset('storage/' . $category->image) }}" alt="Current Image" style="width: 100px; height: auto; margin-top: 10px;">

                            </div>

                            {{-- seo section  --}}
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" value="{{ $category->meta_title }}">
                            </div><div class="form-group">
                                <label>Meta Description</label>
                                <input type="text" class="form-control" name="meta_description" value="{{ $category->meta_description }}">
                            </div><div class="form-group">
                                <label>Meta Keyword</label>
                                <input type="text" class="form-control" name="meta_keyword" value="{{ $category->meta_keyword }}">
                            </div><div class="form-group">
                                <label>Og Url</label>
                                <input type="text" class="form-control" name="og_url" value="{{ $category->og_url }}">
                            </div><div class="form-group">
                                <label>Og Title</label>
                                <input type="text" class="form-control" name="og_title" value="{{ $category->og_title }}">
                            </div><div class="form-group">
                                <label>Og Site Name</label>
                                <input type="text" class="form-control" name="og_site_name" value="{{ $category->og_site_name }}">
                            </div><div class="form-group">
                                <label>Og Type</label>
                                <input type="text" class="form-control" name="og_type" value="{{ $category->og_type }}">
                            </div><div class="form-group">
                                <label>Canonical</label>
                                <input type="text" class="form-control" name="canonical" value="{{ $category->canonical }}">
                            </div><div class="form-group">
                                <label>Og Locale</label>
                                <input type="text" class="form-control" name="og_local" value="{{ $category->og_local }}">
                            </div>
                        <div class="form-group">
                            <label>Og Site Url</label>
                            <input type="text" class="form-control" name="og_site_url" value="{{ $category->og_site_url }}">
                        </div>
                         <div class="form-group">
                            <label>Site Map Url</label>
                            <input type="text" class="form-control" name="site_map" value="{{ $category->site_map }}">
                        </div>
                        <div class="form-group">
                            <label>Robots</label>
                            <input type="text" class="form-control" name="robots" value="{{ $category->robots }}">
                        </div>
                            <button type="submit" class="btn btn-primary common_btn">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
