@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Manage User</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create User</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.manage-user.create')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" value="{{old('password')}}" required>
                                    </div>
                                </div>
                            </div>

                            

                            <!-- Always Visible Fields -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" name="city" value="{{old('city')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="state">State</label>
                                        <input type="text" class="form-control" name="state" value="{{old('state')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" name="country" value="{{old('country')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pincode">Pin Code</label>
                                        <input type="text" class="form-control" name="pincode" value="{{old('pincode')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select id="role" class="form-control" name="role" onchange="toggleFields()">
                                    <option value="">Select</option>
                                    <option {{ (old('role')=="user"?"selected":"") }} value="user">User</option>
                                    <option {{ (old('role')=="vendor"?"selected":"") }} value="vendor">Vendor</option>
                                    <option {{ (old('role')=="admin"?"selected":"") }} value="admin">Admin</option>
                                </select>
                            </div>

                            <!-- Vendor-Specific Fields -->
                            <div id="vendorFields" style="display: none;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="shop_name">Shop Name</label>
                                            <input type="text" class="form-control" name="shop_name" value="{{old('shop_name')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input type="text" class="form-control" name="address" value="{{old('address')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pickup_location">Pickup Location</label>
                                    <input type="text" class="form-control" name="pickup_location" value="{{old('pickup_location')}}" minlength="10" maxlength="36">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function toggleFields() {
        const role = document.getElementById('role').value;
        const vendorFields = document.getElementById('vendorFields');

        if (role === 'vendor') {
            vendorFields.style.display = 'block'; // Show vendor-specific fields
        } else {
            vendorFields.style.display = 'none'; // Hide vendor-specific fields
        }
    }
</script>
@endsection
