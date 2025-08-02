@extends('admin.layouts.master')

@section('content')

<x-dashboard-container>
    <x-card>
        <x-card-header>Add Home Page Details</x-card-header>
        <x-card-body>
            <x-form-element method="POST" enctype="multipart/form-data" id="submitForm" 
                action="{{ isset($homePageDetail) ? route('home.page.update', $homePageDetail->id) : route('home.page.store') }}">
                
                @csrf
                
                @isset($homePageDetail)
                    @method('PUT') <!-- Use PUT for updating -->
                    <x-input type="hidden" name="id" id="id" value="{{ $homePageDetail->id }}"></x-input>
                @endisset
            
                <!-- Desktop Video -->
                {{-- <x-input-with-label-element name="desktop_video" id="desktop_video" type="file"
                    label="Upload Desktop Video" placeholder="Desktop Video" accept="video/*">
                    @isset($homePageDetail)
                        <p>Current Desktop Video:</p>
                        <video width="150" height="150" controls>
                            <source src="{{ asset('storage/' . $homePageDetail->desktop_video) }}" type="video/mp4">
                        </video>
                    @endisset
                </x-input-with-label-element> --}}

                <!-- Mobile Video -->
                {{-- <x-input-with-label-element name="mobile_video" id="mobile_video" type="file"
                    label="Upload Mobile Video" placeholder="Mobile Video" accept="video/*">
                    @isset($homePageDetail)
                        <p>Current Mobile Video:</p>
                        <video width="150" height="150" controls>
                            <source src="{{ asset('storage/' . $homePageDetail->mobile_video) }}" type="video/mp4">
                        </video>
                    @endisset
                </x-input-with-label-element> --}}

                <!-- About Us Images -->
                <x-input-with-label-element name="about_us_images[]" id="about_us_images" type="file"
                    label="Upload About Us Images" placeholder="About Us Images" accept="image/*" multiple>
                    @isset($homePageDetail)
                        <p>Current About Us Images:</p>
                        @foreach(json_decode($homePageDetail->about_us_images) as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="About Us Image" style="width: 50px; height: 50px;">
                        @endforeach
                    @endisset
                </x-input-with-label-element>

                <!-- About Us Short Description -->
                <x-text-area-with-label name="about_us_short_description" placeholder="Description"
                    label="Short Description" class="summernote">{{ old('about_us_short_description', $homePageDetail->about_us_short_description ?? '') }}</x-text-area-with-label>
            
                <!-- Founder Name -->
                <x-input-with-label-element required name="founder_name" id="founder_name" placeholder="Founder Name"
                    label="Founder Name" value="{{ old('founder_name', $homePageDetail->founder_name ?? '') }}"></x-input-with-label-element>
            
                <!-- Founder Image -->
                <x-input-with-label-element name="founder_image" id="founder_image" type="file"
                    label="Founder image" placeholder="image" accept="image/*">
                    @isset($homePageDetail)
                        <p>Current Image:</p>
                        <img src="{{ asset('storage/' . $homePageDetail->founder_image) }}" alt="Founder Image" style="width: 50px; height: 50px;">
                    @endisset
                </x-input-with-label-element>
            
                <!-- Message from Founder -->
                <x-text-area-with-label name="message_from_founder" placeholder="Message"
                    label="Message From Founder" class="summernote">{{ old('message_from_founder', $homePageDetail->message_from_founder ?? '') }}</x-text-area-with-label>
            
                <x-form-buttons></x-form-buttons>
            </x-form-element>
            
        </x-card-body>
    </x-card>

    <!-- Home Details List -->
    <x-card-element header="Home Details">
        @isset($homePageDetails)
        <table id="homeDetailsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>About Us Content</th>
                    {{-- <th>Desktop Video</th>
                    <th>Mobile Video</th> --}}
                    <th>About Us Images</th>
                    <th>Message</th>
                    <th>Founder Name</th>
                    <th>Founder Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($homePageDetails as $detail) <!-- Use the correct plural variable -->
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->about_us_short_description }}</td>
                        {{-- <td>
                            @isset($detail->desktop_video)
                                <video width="150" height="150" controls>
                                    <source src="{{ asset('storage/' . $detail->desktop_video) }}" type="video/mp4">
                                </video>
                            @endisset
                        </td> --}}
                        {{-- <td>
                            @isset($detail->mobile_video)
                                <video width="150" height="150" controls>
                                    <source src="{{ asset('storage/' . $detail->mobile_video) }}" type="video/mp4">
                                </video>
                            @endisset
                        </td> --}}
                        <td>
                            @foreach(json_decode($detail->about_us_images) ?? [] as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="About Us Image" style="width: 50px; height: 50px;">
                            @endforeach
                        </td>
                        <td>{{ $detail->message_from_founder }}</td>
                        <td>{{ $detail->founder_name }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $detail->founder_image) }}" alt="Founder Image" style="width: 50px; height: 50px;">
                        </td>
                        <td>
                            <a href="{{ route('home.page.edit', $detail->id) }}" class="btn btn-primary btn-sm">Edit</a>

                            <!-- Action Buttons -->
                            @if($detail->status == 'enabled')
                                <form action="{{ route('home.page.toggleStatus', $detail->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Disable</button>
                                </form>
                            @else
                                <form action="{{ route('home.page.toggleStatus', $detail->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Enable</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No Home Page Details available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @endisset
    </x-card-element>
</x-dashboard-container>

@endsection

@section('script')
    {{-- @include('Dashboard.include.dataTablesScript') --}}

    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize DataTable
            $('#homeDetailsTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });

            // Initialize Summernote for textareas
            $('.summernote').summernote({
                placeholder: 'Write your message here...',
                tabsize: 2,
                height: 100
            });
        });
    </script>
@endsection
