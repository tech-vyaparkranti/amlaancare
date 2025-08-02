@if (!empty($product->productFonts))
<div class="wsus_choose_font" id="productFontsDiv">
    <h5>Choose Out Side Font :</h5>                                    
</div>
<div class="row">
    @foreach ($product->productFonts as $item)
        <div class="col-md-2">
            <div class='col text-center'>
                <input type="radio"  name="product_font" id="font_image_{{ $item->id }}" class="productFonts d-none imgbgchk" value="{{ $item->id }}">
                    <label for="font_image_{{ $item->id }}">
                    <img  title="<span class='text-white'>{{ $item->font_name }}</span><img src='{{ asset($item->font_sample_image) }}'   alt='{{ $item->font_name }}'  class='img-thumbnail'>" src="{{ asset($item->font_sample_image) }}"  alt="{{ $item->font_name }}"  data-toggle="tooltip" class="zoom img-thumbnail">
                    
                    </label>
                </div>
        </div>
    @endforeach
</div>
@endif