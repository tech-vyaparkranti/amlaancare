@extends('admin.layouts.master')

@section('content')
    <x-dashboard-container>
        <x-card>
            <x-card-header>{{ isset($faqDetail) ? 'Edit FAQ' : 'Add FAQ' }}</x-card-header>
            <x-card-body>
                <form action="{{ isset($faqDetail) ? route('faq.update', $faqDetail->id) : route('faq.store') }}" method="POST">
                    @csrf
                    @if(isset($faqDetail))
                        @method('PUT')
                    @endif
                
                    <!-- FAQ Fields (Dynamic) -->
                    <div id="faq-section">
                        <h5>FAQ Management</h5>
                        @if(isset($faqData))
                            @foreach($faqData as $index => $faq)
                                <div class="faq-item">
                                    <div class="form-group row">
                                        <div class="col-md-5">
                                            <label for="faq[{{ $index }}][question]">Question</label>
                                            <input type="text" name="faq[{{ $index }}][question]" class="form-control" value="{{ old('faq.' . $index . '.question', $faq['question']) }}" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="faq[{{ $index }}][answer]">Answer</label>
                                            <textarea name="faq[{{ $index }}][answer]" class="form-control" rows="3" required>{{ old('faq.' . $index . '.answer', $faq['answer']) }}</textarea>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center justify-content-end">
                                            <button type="button" class="btn btn-danger btn-sm delete-faq">-</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Empty FAQ Item to start -->
                            <div class="faq-item">
                                <div class="form-group row">
                                    <div class="col-md-5">
                                        <label for="faq[0][question]">Question</label>
                                        <input type="text" name="faq[0][question]" class="form-control" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="faq[0][answer]">Answer</label>
                                        <textarea name="faq[0][answer]" class="form-control" rows="3" required></textarea>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-center justify-content-end">
                                        <button type="button" class="btn btn-danger btn-sm delete-faq">-</button>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                
                    <!-- Add FAQ Button -->
                    <div class="d-flex justify-content-end mt-2">
                        <button type="button" id="add-faq" class="btn btn-info">+</button>
                    </div>
                
                    <!-- Status Toggle -->
                    <div class="form-group mt-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="enabled" {{ isset($faqDetail) && $faqDetail->status == 'enabled' ? 'selected' : '' }}>Active</option>
                            <option value="disabled" {{ isset($faqDetail) && $faqDetail->status == 'disabled' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </x-card-body>
        </x-card>

        <!-- Data Table -->
        <x-card class="mt-4">
            <x-card-header>FAQ List</x-card-header>
            <x-card-body>
                @isset($faqDetails)
                <table id="faq-table" class="table table-bordered table-striped">
                    <thead>
                        
                        <tr>
                            <th>ID</th>
                            <th>FAQs</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($faqDetails as $faq)
                            <tr>
                                <td>{{ $faq->id }}</td>
                                <td>
                                    @foreach(json_decode($faq->faq) as $faqItem)
                                        <strong>Q:</strong> {{ $faqItem->question }} <br>
                                        <strong>A:</strong> {{ $faqItem->answer }} <br><br>
                                    @endforeach
                                </td>
                                <td>{{ ucfirst($faq->status) }}</td>
                                <td>
                                    <a href="{{ route('faq.edit', $faq->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('faq.toggleStatus', $faq->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-danger btn-sm">{{ $faq->status == 'enabled' ? 'Disable' : 'Enable' }}</button>
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

    @push('scripts')
        <script>
            $(document).ready(function () {
                // Initialize DataTable
                $('#faq-table').DataTable();

                // Initialize the FAQ index dynamically
                let faqIndex = {{ isset($faqData) ? count($faqData) : 1 }}; // Start with current FAQ count

                // Add new FAQ section dynamically
                $('#add-faq').click(function () {
                    const faqSection = `
                        <div class="faq-item">
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="faq[${faqIndex}][question]">Question</label>
                                    <input type="text" name="faq[${faqIndex}][question]" class="form-control" required>
                                </div>
                                <div class="col-md-5">
                                    <label for="faq[${faqIndex}][answer]">Answer</label>
                                    <textarea name="faq[${faqIndex}][answer]" class="form-control" rows="3" required></textarea>
                                </div>
                                <div class="col-md-2 d-flex align-items-center justify-content-end">
                                    <button type="button" class="btn btn-danger btn-sm delete-faq">-</button>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#faq-section').append(faqSection);
                    faqIndex++;
                });

                // Delete FAQ section
                $(document).on('click', '.delete-faq', function () {
                    $(this).closest('.faq-item').remove();
                });
            });
        </script>
    @endpush
@endsection
