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
                        <h4>Create Category</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- <div class="form-group">
                                <label>Icon</label>
                                <div>
                                    <button class="btn btn-primary common_btn" data-icon="" data-selected-class="btn-danger"
                                            data-unselected-class="btn-info" role="iconpicker" name="icon"></button>
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <label>Category Image <b>( D:1420px X 350px )</b></label>
                                <input type="file" class="form-control" name="category_banner" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="form-group">
                                <label>Minimum Quantity</label>
                                <input type="text" class="form-control" name="min_quantity">
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                            </div>


                            {{-- seo section  --}}
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" >
                            </div><div class="form-group">
                                <label>Meta Description</label>
                                <input type="text" class="form-control" name="meta_description" >
                            </div><div class="form-group">
                                <label>Meta Keyword</label>
                                <input type="text" class="form-control" name="meta_keyword" >
                            </div><div class="form-group">
                                <label>Og Url</label>
                                <input type="text" class="form-control" name="og_url">
                            </div><div class="form-group">
                                <label>Og Title</label>
                                <input type="text" class="form-control" name="og_title">
                            </div><div class="form-group">
                                <label>Og Site Name</label>
                                <input type="text" class="form-control" name="og_site_name">
                            </div><div class="form-group">
                                <label>Og Type</label>
                                <input type="text" class="form-control" name="og_type">
                            </div><div class="form-group">
                                <label>Canonical</label>
                                <input type="text" class="form-control" name="canonical">
                            </div><div class="form-group">
                                <label>Og Locale</label>
                                <input type="text" class="form-control" name="og_local">
                            </div>
                        <div class="form-group">
                            <label>Og Site Url</label>
                            <input type="text" class="form-control" name="og_site_url">
                        </div>
                         <div class="form-group">
                            <label>Site Map Url</label>
                            <input type="text" class="form-control" name="site_map">
                        </div>
                        <div class="form-group">
                            <label>Robots</label>
                            <input type="text" class="form-control" name="robots">
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
