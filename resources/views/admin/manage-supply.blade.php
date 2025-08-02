@extends('admin.layouts.master')

@section('content')
    <x-dashboard-container>
        <x-card>
            <x-card-header>{{ isset($supplyChainDetail) ? 'Edit Content' : 'Add Content' }}</x-card-header>
            <x-card-body>
                <form action="{{ isset($supplyChainDetail) ? route('supplyChain.update', $supplyChainDetail->id) : route('supplyChain.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($supplyChainDetail))
                        @method('PUT')
                    @endif

                    <!-- Single Image Upload and Title Input on the same line -->
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="image">Upload Image</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                            @if(isset($supplyChainDetail) && $supplyChainDetail->image)
                                <img src="{{ asset('storage/' . $supplyChainDetail->image) }}" alt="image" width="100" class="mt-2">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $supplyChainDetail->title ?? '') }}" required>
                        </div>
                    </div>

                    <!-- Content Editor (Summernote) -->
                    <div class="form-group">
                        <label for="content">Content</label>
                        <textarea name="content" id="summernote" class="form-control">{{ old('content', $supplyChainDetail->content ?? '') }}</textarea>
                    </div>

                    <!-- FAQ Fields (Dynamic) -->
                    <div id="faq-section">
                        <h5>Supply Chain FAQs</h5>
                        @if(isset($faqData))
                            @foreach($faqData as $index => $faq)
                                <div class="faq-item">
                                    <div class="form-group row">
                                        <div class="col-md-5">
                                            <label for="faq[{{ $index }}][question]">Question</label>
                                            <input type="text" name="faq[{{ $index }}][question]" class="form-control" value="{{ old('faq.' . $index . '.question', $faq->question) }}" required>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="faq[{{ $index }}][answer]">Answer</label>
                                            <textarea name="faq[{{ $index }}][answer]" class="form-control" rows="3" required>{{ old('faq.' . $index . '.answer', $faq->answer) }}</textarea>
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

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </x-card-body>
        </x-card>

        <!-- Data Table -->
        <x-card class="mt-4">
            <x-card-header>Content List</x-card-header>
            <x-card-body>
                @isset($supplyChainDetails)
                    <table id="content-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th>FAQs</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supplyChainDetails as $content)
                                <tr>
                                    <td>{{ $content->id }}</td>
                                    <td><img src="{{ asset('storage/' . $content->image) }}" alt="image" width="50"></td>
                                    <td>{{ $content->title }}</td>
                                    <td>{{ \Str::limit($content->content, 50) }}</td>
                                    <td>
                                        @foreach(json_decode($content->faq) as $faq)
                                            <strong>Q:</strong> {{ $faq->question }} <br>
                                            <strong>A:</strong> {{ $faq->answer }} <br><br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('supplyChain.edit', $content->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('supplyChain.toggleStatus', $content->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger btn-sm">{{ $content->status == 'active' ? 'Disable' : 'Enable' }}</button>
                                        </form>
                                        {{-- <form action="{{ route('supplyChain.destroy', $content->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form> --}}
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
                $('#content-table').DataTable();

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
