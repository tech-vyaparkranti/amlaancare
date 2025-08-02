@extends('admin.layouts.master')
@section('title',"Product Font Master")

@section('content')
      <!-- Main Content -->
        <section class="section">
          <div class="section-header">
            <h1>Product Font Master</h1>

          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Update Font</h4>
                  </div>
                  <div class="card-body">
                    <form action="{{route('admin.font-master.update', $fontMaster->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Preview</label>
                            <br>
                            <img src="{{asset($fontMaster->font_sample_image)}}" style="width:200px" alt="">
                        </div>

                        <div class="form-group">
                            <label>Font Name</label>
                            <input type="text" class="form-control" name="font_name" value="{{ old('font_name')??$fontMaster->font_name }}">
                        </div>

                        <div class="form-group">
                            <label>Font Sample Image</label>
                            <input type="file" class="form-control" name="font_sample_image" value="{{ old('font_sample_image') }}">
                        </div>
                        <div class="form-group">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status">
                                <option {{ (old('status')??$fontMaster->status) == '1' ? 'selected' : '' }} value="1">Active</option>
                                <option {{ (old('status')??$fontMaster->status) == '0' ? 'selected' : '' }} value="0">Inactive</option>
                            </select>
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
