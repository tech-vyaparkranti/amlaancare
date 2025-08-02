@extends('admin.layouts.master')
@section('content')


<x-dashboard-container>
    <x-card>
        <x-card-header>{{ isset($certification) ? 'Edit Certification' : 'Add Certification' }}</x-card-header>
        <x-card-body>
            <!-- Certification Form (Add/Edit) -->
            <form action="{{ isset($certification) ? route('certifications.store') : route('certifications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($certification))
                    @method('PUT')
                    <input type="hidden" name="certification_id" id="certificationId" value="{{ $certification->id }}">
                @endif
            
                <!-- Single Image Upload and Status -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="image">Upload Image</label>
                        <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        @if(isset($certification) && $certification->image)
                            <img src="{{ asset('storage/' . $certification->image) }}" alt="image" width="100" class="mt-2">
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active" {{ isset($certification) && $certification->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ isset($certification) && $certification->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            
                <!-- Sorting (Serial) -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="serial">Sorting (Serial)</label>
                        <input type="number" name="serial" id="serial" class="form-control" value="{{ old('serial', $certification->serial ?? '') }}" required>
                    </div>
                </div>
            
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary mt-3" id="submitButton">{{ isset($certification) ? 'Update' : 'Save' }}</button>
            </form>
            
        </x-card-body>
    </x-card>

    <!-- Data Table for Certifications -->
    <x-card class="mt-4">
        <x-card-header>Certifications List</x-card-header>
        <x-card-body>
            @isset($certifications)
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Sorting</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($certifications as $certification)
                            <tr>
                                <td>{{ $certification->id }}</td>
                                <td>
                                    @if($certification->image)
                                        <img src="{{ asset('storage/' . $certification->image) }}" alt="{{ $certification->image }}" width="100">
                                    @else
                                        <img src="{{ asset('frontend/images/default-certification.jpg') }}" alt="Default Image" width="100">
                                    @endif
                                </td>
                                <td>{{ ucfirst($certification->status) }}</td>
                                <td>{{ $certification->serial }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    {{-- <button class="btn btn-info btn-sm" onclick="editCertification({{ $certification->id }})">Edit</button> --}}


                                    <!-- Enable/Disable Button -->
                                    <form action="{{ route('certifications.toggleStatus', $certification->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm">
                                            {{ $certification->status == 'active' ? 'Disable' : 'Enable' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endisset
        </x-card-body>
    </x-card>
</x-dashboard-container>
@endsection

@section('scripts')
<script>
    // DataTable initialization
    $(document).ready(function() {
        $('#certificationsTable').DataTable();
    });

    // Edit Certification Function (Populates form with data)
    // Edit Certification Function (Populates form with data)
function editCertification(id) {
    // Fetch Certification Data
    $.ajax({
        url: '/admin/certifications/' + id + '/edit',
        method: 'GET',
        success: function(response) {
            // Pre-fill the form with the certification data
            $('#certificationId').val(response.certification.id);
            $('#status').val(response.certification.status);
            $('#serial').val(response.certification.serial);
            // If an image exists, display the image (optional)
            if (response.certification.image) {
                $('#image').next('.custom-file-label').text(response.certification.image);
            }
            // Change the button text from 'Save' to 'Update'
            $('#submitButton').text('Update');
        },
        error: function() {
            alert("Error fetching data for editing.");
        }
    });
}
</script>
@endsection

