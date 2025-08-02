<div class="products_list_item">
    <div class="product_item">
        @if (strpos($product->product_type, 'new') !== false)
            <span class="new">{{productType($product->product_type)}}</span>
        @endif
        <a class="pro_link" href="{{route('product-detail', $product->slug)}}">
            <img src="{{asset($product->thumb_image)}}" alt="{{ $product->name }}" class="img-fluid w-100 img_1">
            <img src="{{asset($product->thumb_image)}}" alt="{{ $product->name }}" class="img-fluid w-100 img_2">
        </a>
        <ul class="single_pro_icon">
            <li>
                <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="show_product_modal" data-id="{{ $product->id }}">
                    <i class="far fa-eye" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <a href="#" class="add_to_wishlist" data-id="{{ $product->id }}">
                    <i class="far fa-heart" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
        <div class="product_details">
            <a class="pro_name" href="{{route('product-detail', $product->slug)}}">{{limitText($product->name, 53)}}</a>
            {{-- <p class="stock_area">
                <span class="{{ $product->in_stock ? 'in_stock' : 'out_of_stock' }}">
                    {{ $product->in_stock ? 'In Stock' : 'Out of+ Stock' }}
                </span> ({{ $product->stock_count }} items)
            </p> --}}
            <p class="pro_rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $product->ratings_avg_review)
                        <i class="fas fa-star" aria-hidden="true"></i>
                    @else
                        <i class="far fa-star" aria-hidden="true"></i>
                    @endif
                @endfor
                <span>({{$product->reviews_count}} review)</span>
            </p>
            <a class="category" href="{{route('product-detail', $product->slug)}}">Shop Now</a>
            <p class="price">₹{{ $product->price }}</p>
            <form class="shopping-cart-form" method="POST" action="" hidden>
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="qty" value="1" min="1" max="100">
                <button class="add_cart" type="submit">Add to Cart</button>
            </form>
        </div>
    </div>
</div>












