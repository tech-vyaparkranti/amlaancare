@if (!empty($product_zip_colours) && count($product_zip_colours))
<div class="wsus_choose_font" id="zip_colour_nameDiv">
    <h5>Choose Zip :</h5>                                    
</div>
<div class="row">
    @foreach ($product_zip_colours as $item)
        <div class="col-md-2 overflow-hidden" >
            <div class='col text-center' >
                <input type="radio" name="zip_colour_name" id="zip_color_image_{{ $item->id }}" class="d-none imgbgchk zip_colour_name" value="{{ $item->id }}">
                    <label for="zip_color_image_{{ $item->id }}">
                    <img id="zip_color_image_{{ $item->id }}" src="{{ asset($item->colour_sample_image) }}" title="<span class='text-white'>{{ $item->colour_name }}</span><img src='{{ asset($item->colour_sample_image) }}'   alt='{{ $item->colour_name }}'  class='img-thumbnail'>" alt="{{ $item->colour_name }}" data-toggle="tooltip"  class="img-thumbnail tooltip_class">
                    
                    </label>
                </div>
        </div>
    @endforeach
</div>
@endif