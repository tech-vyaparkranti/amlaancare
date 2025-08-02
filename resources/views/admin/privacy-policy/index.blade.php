{{-- @extends('admin.layouts.master')

@section('content')

        <section class="section">
          <div class="section-header">
            <h1>Shipping Policy</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">

                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.about.update')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="summernote">{!!@$content->content!!}</textarea>
                        </div>

                        <button type="submmit" class="btn btn-primary common_btn">Update</button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection --}}

@extends('admin.layouts.master')

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Privacy Policy</h1>
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <!-- Optional header content -->
                  </div>
                  <div class="card-body">
                    <form action="{{ route('admin.privacy-policy.update') }}" method="POST">
                        @csrf
                        @method('PUT') <!-- This is correct for update methods -->
                        <div class="form-group">
                            <label>Content</label>
                            <!-- Assuming content is an HTML field, you use summernote or any WYSIWYG editor -->
                            <textarea name="content" class="summernote">{{ old('content', $privacy->content ?? '') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary common_btn">Update</button> <!-- Corrected the button type -->
                    </form>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </section>

@endsection

