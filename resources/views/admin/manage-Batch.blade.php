@extends('admin.layouts.master')

@section('content')
<x-dashboard-container>
    <x-card>
        <x-card-header>{{ isset($batchDetail) ? 'Edit' : 'Add' }} Batch Details</x-card-header>
        <x-card-body>
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm"
                action="{{ isset($batchDetail) ? route('batch.update', $batchDetail->id) : route('batch.store') }}">

                @csrf
                @isset($batchDetail)
                    @method('PUT') <!-- Use PUT for updating -->
                    <x-input type="hidden" name="id" id="id" value="{{ $batchDetail->id }}"></x-input>
                @endisset

                <!-- Batch Number -->
                <x-input-with-label-element required name="batch_number" id="batch_number" placeholder="Batch Number"
                    label="Batch Number" value="{{ old('batch_number', $batchDetail->batch_number ?? '') }}"></x-input-with-label-element>

                <!-- Batch Name -->
                <x-input-with-label-element required name="batch_name" id="batch_name" placeholder="Batch Name"
                    label="Batch Name" value="{{ old('batch_name', $batchDetail->batch_name ?? '') }}"></x-input-with-label-element>

                <!-- Start Date -->
                <x-input-with-label-element required name="start_date" id="start_date" type="date"
                    label="Start Date" value="{{ old('start_date', $batchDetail->start_date ?? '') }}"></x-input-with-label-element>

                <!-- PDF Upload -->
                <x-input-with-label-element name="pdf_url" id="pdf_url" type="file"
                    label="Upload PDF" placeholder="PDF" accept=".pdf">
                    @isset($batchDetail)
                        <p>Current PDF:</p>
                        <a href="{{ asset('storage/' . $batchDetail->pdf_url) }}" target="_blank">View PDF</a>
                    @endisset
                </x-input-with-label-element>

                <x-form-buttons></x-form-buttons>
            </x-form-element>

        </x-card-body>
    </x-card>

    <!-- Batch Details List -->
    <x-card-element header="Batch Details">
        @isset($batchDetails)
        <table id="batchDetailsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Batch Number</th>
                    <th>Batch Name</th>
                    <th>Start Date</th>
                    <th>PDF</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($batchDetails as $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->batch_number }}</td>
                        <td>{{ $detail->batch_name }}</td>
                        <td>{{ date('d M Y', strtotime($detail->start_date)) }}</td>
                        <td>
                            @isset($detail->pdf_url)
                            <a href="{{ asset('storage/' . $detail->pdf_url) }}" target="_blank">View PDF</a>

                            @endisset
                        </td>
                        <td>
                            <!-- Edit Button (Show the Edit Form on the same page) -->
                            <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $detail->id }}">Edit</button>

                            <!-- Toggle Status Button -->
                            <form action="{{ route('batch.toggleStatus', $detail->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-{{ $detail->status == 'enabled' ? 'danger' : 'success' }} btn-sm">
                                    {{ $detail->status == 'enabled' ? 'Disable' : 'Enable' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No Batch Details available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @endisset
    </x-card-element>
</x-dashboard-container>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Initialize DataTable
        $('#batchDetailsTable').DataTable();

        // Handle Edit button click
        $(document).on('click', '.edit-btn', function() {
            var batchId = $(this).data('id');

            $.ajax({
                url: '/admin/batch/' + batchId + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#batch_number').val(data.batch_number);
                    $('#batch_name').val(data.batch_name);
                    $('#start_date').val(data.start_date);

                    $('#submitForm').attr('action', '/admin/batch/' + batchId);
                    $('#submitForm').append('<input type="hidden" name="_method" value="PUT">');
                },
                error: function() {
                    alert("Could not fetch batch details.");
                }
            });
        });
    });
</script>
@endsection
