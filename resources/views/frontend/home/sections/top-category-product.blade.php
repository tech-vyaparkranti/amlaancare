@php
    $popularCategories = json_decode($popularCategory->value??"{}", true);
    // dd($popularCategories)
@endphp
<section id="monthly_top" class="monthly_top_2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                @if (!empty($homepage_secion_banner_one->banner_one->status) && $homepage_secion_banner_one->banner_one->status == 1)
                <div class="monthly_top_banner">
                    <a href="{{$homepage_secion_banner_one->banner_one->banner_url}}">
                        <img class="img-fluid" src="{{asset($homepage_secion_banner_one->banner_one->banner_image)}}" alt="">
                    </a>
                </div>
                @endif
            </div>
        </div>
        @if (!empty($popularCategories))
         
        <div class="row">
            <div class="col-xl-12">
                <div class="section_header for_md">
                    <h3>Popular Categories</h3>
                    <div class="monthly_top_filter">

                        @php
                            $products = [];
                        @endphp
                        @foreach ($popularCategories as $key => $popularCategory)
                        @php
                            $lastKey = [];

                            foreach($popularCategory as $key => $category){
                                if($category === null ){
                                    break;
                                }
                                $lastKey = [$key => $category];
                            }

                            if(array_keys($lastKey)[0] === 'category'){
                                $category = \App\Models\Category::find($lastKey['category']);
                                if(!empty($category)){
                                    $products[] = \App\Models\Product::withAvg('reviews', 'rating')
                                    ->with(['variants', 'category', 'productImageGalleries'])
                                    ->where('category_id', $category->id)->orderBy('id', 'DESC')->take(12)->get();
                                }
                                
                            }elseif(array_keys($lastKey)[0] === 'sub_category'){
                                $category = \App\Models\SubCategory::find($lastKey['sub_category']);
                                if (!empty($category)){
                                    $products[] = \App\Models\Product::withAvg('reviews', 'rating')
                                    ->with(['variants', 'category', 'productImageGalleries'])
                                    ->where('sub_category_id', $category->id)->orderBy('id', 'DESC')->take(12)->get();
                                }                                 
                            }else {
                                $category = \App\Models\ChildCategory::find($lastKey['child_category']);
                                if(!empty($category)){
                                    $products[] = \App\Models\Product::withAvg('reviews', 'rating')
                                ->with(['variants', 'category', 'productImageGalleries'])
                                ->where('child_category_id', $category->id)->orderBy('id', 'DESC')->take(12)->get();
                                }
                            }

                        @endphp
                        @if (!empty($category))
                        <button class="{{ $loop->index === 0 ? 'auto_click active' : ''}}" data-filter=".category-{{$loop->index}}">{{$category->name}}</button>
                        @endif
                        
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid">
                    @if (!empty($products))
                    @foreach ($products as $key => $product)
                        @foreach ($product as $item)
                            <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3  category-{{$key}}">
                                <a class="hot_deals__single" href="{{route('product-detail', $item->slug)}}">
                                    <div class="hot_deals__single_img">
                                        <img src="{{asset($item->thumb_image)}}" alt="bag" class="img-fluid w-100">
                                    </div>
                                    <div class="hot_deals__single_text">
                                        <h5>{!!limitText($item->name, )!!}</h5>
                                        <p class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $item->reviews_avg_rating)
                                                <i class="fas fa-star"></i>
                                                @else
                                                <i class="far fa-star"></i>
                                                @endif
                                            @endfor

                                        </p>
                                        @if (checkDiscount($item))
                                            <p class="tk">{{$settings->currency_icon ?? ''}}{{$item->offer_price}} <del>{{$settings->currency_icon ?? ''}}{{$item->price}}</del></p>
                                        @else
                                            <p class="tk">{{$settings->currency_icon ?? ''}}{{$item->price}}</p>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
