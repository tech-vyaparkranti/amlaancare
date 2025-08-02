@if(!empty($product) && !empty($product->category->name))
{{-- <div class="col-xl-3 col-sm-6 col-lg-4 {{ @$key }}"> --}}
<div class="products_list_item {{ @$key }}">
    <div class="product_item">
        <span class="new">{{productType($product->product_type)}}</span>
        @if(checkDiscount($product))
            <span class="minus">-{{calculateDiscountPercent($product->price, $product->offer_price)}}%</span>
        @endif
        <a class="pro_link" href="{{route('product-detail', $product->slug)}}">
            <img src="{{asset($product->thumb_image)}}" alt="product" class="img-fluid w-100 img_1" />
            <img src="
            @if(isset($product->productImageGalleries[0]->image))
                {{asset($product->productImageGalleries[0]->image)}}
            @else
                {{asset($product->thumb_image)}}
            @endif
            " alt="product" class="img-fluid w-100 img_2" />
        </a>
        <ul class="single_pro_icon">
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="show_product_modal" data-id="{{ $product->id }}"><i class="far fa-eye"></i></a></li>
            <li><a href="" class="add_to_wishlist" data-id="{{$product->id}}"><i class="far fa-heart"></i></a></li>
            {{-- <li><a href="#"><i class="far fa-random"></i></a> --}}
        </ul>
        <div class="product_details" style="justify-content: flex-start">

            <a class="pro_name" href="{{route('product-detail', $product->slug)}}" style="justify-content: flex-start">{{limitText($product->name, 52)}}</a>
            {{-- <p class="pro_rating">

                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $product->reviews_avg_rating)
                        <i class="fas fa-star"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor

                <span>({{$product->reviews_count}} review)</span>

            </p>
            --}}
              <!-- Review Section -->
              <div class="product_review mt-1 d-flex align-items-center" style="justify-content: flex-start; font-size: 12px;">
                <span class="rating" style="color: #f39c12; font-size: 12px; line-height: 1;">
                   4.8 ⭐
                </span>
                <span class="review_count" style="margin-left: 5px; color: #555; font-size: 12px; line-height: 1;">
                    ({{ $product->reviews_count ?? '0' }} reviews)
                </span>
            </div>

        <!-- Review Section -->
            <a class="category" href="#" style="justify-content: flex-start">{{$product->category->name}} </a>
            @if(checkDiscount($product))
                <p class="price" style="justify-content: flex-start" >{{$settings->currency_icon ?? ''}}{{$product->offer_price}} <del>{{$settings->currency_icon ?? ''}}{{$product->price}}</del></p>
            @else
                <p class="price" style="justify-content: flex-start">{{$settings->currency_icon ?? ''}}{{$product->price}}</p>
            @endif
            <div class="row">
                {{-- <div class="col-md-6"> --}}
                <div class="col-md-12">
                    {{-- <form class="shopping-cart-form">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        @foreach ($product->variants as $variant)
                        @if ($variant->status != 0)
                            <select class="d-none" name="variants_items[]">
                                @foreach ($variant->productVariantItems as $variantItem)
                                    @if ($variantItem->status != 0)
                                        <option value="{{$variantItem->id}}" {{$variantItem->is_default == 1 ? 'selected' : ''}}>{{$variantItem->name}} (${{$variantItem->price}})</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif
                        @endforeach
                        <input class="" name="qty" type="hidden" min="1" max="100" value="1" />
                        <button class="add_cart" type="submit">add to cart</button>
                        <a href="{{route('product-detail', $product->slug)}}" class="add_cart">Enquiry Now</a>
                    </form> --}}
                    {{-- <form class="shopping-cart-form d-none">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="qty" value="1" min="1" max="100">
                                    <button class="add_cart btn btn-primary mt-2" type="submit">Add to Cart</button>
                                </form> --}}
                                <form class="shopping-cart-form" method="POST" action="">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <div class="quantity-selector" style="display: none; align-items: center; gap: 8px; margin-bottom: 8px;">
        <button type="button" class="qty-btn minus" aria-label="Decrease quantity">−</button>
        <input class="number_area" name="qty" type="number" min="1" max="100" value="1" readonly style="width: 45px; text-align: center;">
        <button type="button" class="qty-btn plus" aria-label="Increase quantity">+</button>
        <button type="submit" class="add_cart_button" style="margin-left:10px;">
            Add To Cart <i class="fa fa-shopping-cart"></i>
        </button>
    </div>
    <button type="button" class="show-qty-btn add_cart_button">
        Add To Cart <i class="fa fa-shopping-cart"></i>
    </button>
</form>

                </div>
                {{-- <div class="col-md-6">
                    <form class="shopping-cart-form-buy-now">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        @foreach ($product->variants as $variant)
                        @if ($variant->status != 0)
                            <select class="d-none" name="variants_items[]">
                                @foreach ($variant->productVariantItems as $variantItem)
                                    @if ($variantItem->status != 0)
                                        <option value="{{$variantItem->id}}" {{$variantItem->is_default == 1 ? 'selected' : ''}}>{{$variantItem->name}} (${{$variantItem->price}})</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif
                        @endforeach
                        <input class="" name="qty" type="hidden" min="1" max="100" value="1" />
                        <button class="buy_now" type="submit">Buy Now</button>
                    </form>
                </div> --}}
            </div>

        </div>
    </div>
</div>



<style>

.product-row {
    display: flex;
    flex-wrap: wrap;
}

.product-col {
    flex: 0 0 20%; /* 100% / 5 = 20% width per column */
    max-width: 20%;
}



/* Optional: Media Query to make it responsive */
@media (min-width: 576px) {
    .product-col {
        flex: 0 0 50%; /* 2 per row on small screens */
        max-width: 50%;
    }
}

@media (min-width: 768px) {
    .product-col {
        flex: 0 0 33.3333%; /* 3 per row on medium screens */
        max-width: 33.3333%;
    }
}

@media (min-width: 992px) {
    .product-col {
        flex: 0 0 20%; /* 5 per row on large screens (default) */
        max-width: 20%;
    }
}

.quantity-selector {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
    justify-content: center;
}
.qty-btn {
    background: #e7f6e7;
    border: none;
    color: #137333;
    font-size: 20px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    cursor: pointer;
    font-weight: bold;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.qty-btn:hover {
    background: #d2ebd2;
}
.number_area {
    border: 1px solid #ccc;
    border-radius: 6px;
    padding: 2px 0;
    text-align: center;
    width: 45px;
    font-size: 16px;
    background: #fff;
    color: #333;
    font-weight: 600;
}

</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.shopping-cart-form').forEach(function(form) {
        const showQtyBtn = form.querySelector('.show-qty-btn');
        const qtySelector = form.querySelector('.quantity-selector');
        if (showQtyBtn && qtySelector) {
            showQtyBtn.addEventListener('click', function() {
                showQtyBtn.style.display = 'none';
                qtySelector.style.display = 'flex';
            });
        }
        // Plus/minus logic
        const minus = form.querySelector('.qty-btn.minus');
        const plus = form.querySelector('.qty-btn.plus');
        const input = form.querySelector('input[name="qty"]');
        if (minus && plus && input) {
            minus.onclick = function() {
                let val = parseInt(input.value) || 1;
                if (val > 1) input.value = val - 1;
            };
            plus.onclick = function() {
                let val = parseInt(input.value) || 1;
                if (val < 100) input.value = val + 1;
            };
        }
    });
});
</script>
@endif
