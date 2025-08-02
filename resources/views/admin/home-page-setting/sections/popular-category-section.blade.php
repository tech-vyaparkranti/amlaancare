@php
    // Decode JSON and ensure it is an array
    $popularCategorySection = $popularCategorySection ? json_decode($popularCategorySection->value) : [];
@endphp

<div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin.popular-category-section') }}" method="POST">
                @csrf
                @method('PUT')

                @foreach (range(1, 4) as $i)
                    <h5>Category {{ $i }}</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <select name="cat_{{ $i }}" class="form-control main-category">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option
                                            {{ (isset($popularCategorySection[$i - 1]) && $category->id == $popularCategorySection[$i - 1]->category) ? 'selected' : '' }}
                                            value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $subCategories = isset($popularCategorySection[$i - 1]) ?
                                        \App\Models\SubCategory::where('category_id', $popularCategorySection[$i - 1]->category)->get() :
                                        collect();
                                @endphp
                                <label>Sub Category</label>
                                <select name="sub_cat_{{ $i }}" class="form-control sub-category">
                                    <option value="">Select</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option
                                            {{ (isset($popularCategorySection[$i - 1]) && $subCategory->id == $popularCategorySection[$i - 1]->sub_category) ? 'selected' : '' }}
                                            value="{{ $subCategory->id }}">{{ $subCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                @php
                                    $childCategories = isset($popularCategorySection[$i - 1]) ?
                                        \App\Models\ChildCategory::where('sub_category_id', $popularCategorySection[$i - 1]->sub_category)->get() :
                                        collect();
                                @endphp
                                <label>Child Category</label>
                                <select name="child_cat_{{ $i }}" class="form-control child-category">
                                    <option value="">Select</option>
                                    @foreach ($childCategories as $childCategory)
                                        <option
                                            {{ (isset($popularCategorySection[$i - 1]) && $childCategory->id == $popularCategorySection[$i - 1]->child_category) ? 'selected' : '' }}
                                            value="{{ $childCategory->id }}">{{ $childCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary common_btn">Update</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('body').on('change', '.main-category', function() {
            let id = $(this).val();
            let row = $(this).closest('.row');

            $.ajax({
                method: 'GET',
                url: "{{ route('admin.get-subcategories') }}",
                data: { id: id },
                success: function(data) {
                    let selector = row.find('.sub-category');
                    selector.html('<option value="">Select</option>');

                    $.each(data, function(i, item) {
                        selector.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        $('body').on('change', '.sub-category', function() {
            let id = $(this).val();
            let row = $(this).closest('.row');

            $.ajax({
                method: 'GET',
                url: "{{ route('admin.product.get-child-categories') }}",
                data: { id: id },
                success: function(data) {
                    let selector = row.find('.child-category');
                    selector.html('<option value="">Select</option>');

                    $.each(data, function(i, item) {
                        selector.append(`<option value="${item.id}">${item.name}</option>`);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endpush
