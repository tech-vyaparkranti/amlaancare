@php
    $categoryProductSliderSectionOne = json_decode($categoryProductSliderSectionOne->value??"{}");
    $lastKey = [];

    foreach($categoryProductSliderSectionOne as $key => $category){
        if($category === null ){
            break;
        }
        $lastKey = [$key => $category];
    }
    if(!empty($lastKey)){
        if(array_keys($lastKey)[0] === 'category'){
        $category = \App\Models\Category::find($lastKey['category']);
        if(!empty($category)){
            $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where('category_id', $category->id)->orderBy('id', 'DESC')->take(12)->get();
        }
        
    }elseif(array_keys($lastKey)[0] === 'sub_category'){
        $category = \App\Models\SubCategory::find($lastKey['sub_category']);
        if(!empty($category)){
        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where('sub_category_id', $category->id)->orderBy('id', 'DESC')->take(12)->get();
        }
    }else {
        $category = \App\Models\ChildCategory::find($lastKey['child_category']);
        if(!empty($category)){
        $products = \App\Models\Product::withAvg('reviews', 'rating')->withCount('reviews')
        ->with(['variants', 'category', 'productImageGalleries'])
        ->where('child_category_id', $category->id)->orderBy('id', 'DESC')->take(12)->get();
        }
    }
    }
    
@endphp
<section id="electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="section_header">
                    <h3>{{$category->name??""}}</h3>
                    <a class="see_btn" href="{{ !empty($category->slug)?route('products.index', ['category' => $category->slug]):""}}">see more <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">
            @isset($products)
            @foreach ($products as $product)
            <x-product-card :product="$product" />
        @endforeach
            @endisset
           
        </div>
    </div>
</section>
