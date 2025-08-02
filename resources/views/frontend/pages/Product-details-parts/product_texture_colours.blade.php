@if (!empty($product_texture_colours))
<div class="wsus_choose_font" id="textureColoursDiv">
    <h5>Choose Your Bag Color :</h5>                                    
</div>
<div class="row">
    @foreach ($product_texture_colours as $item)
        <div class="col-md-2 overflow-hidden" >
            <div class='col text-center' >
                <input type="radio"  name="colour_name" id="color_image_{{ $item->id }}" class="colour_name_images d-none imgbgchk" value="{{ $item->id }}">
                    <label for="color_image_{{ $item->id }}">
                    <img  src="{{ asset($item->colour_sample_image) }}" title="<span class='text-white'>{{ $item->colour_name }}</span><img src='{{ asset($item->colour_sample_image) }}'   alt='{{ $item->colour_name }}'  class='img-thumbnail'>" alt="{{ $item->colour_name }}" data-toggle="tooltip"  class="img-thumbnail tooltip_class">
                    
                    </label>
                </div>
        </div>
    @endforeach
</div>
@endif