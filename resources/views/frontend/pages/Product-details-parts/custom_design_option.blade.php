@if ($product->custom_design_option=='yes')
    <div class="cstmname mb-2">
        <h5 class="w-100" for="flexSwitchCheckDefault">Add your custom design : <span style="display: none;" id="custom_design_price">(+ {{$settings->currency_icon ?? ''}} {{ $product->custom_design_option_price }})</span></h5>
    </div>    
    <div class="form-check form-switch">
        <input name="custom_design_option" value="yes" class="form-check-input" onclick="showDiv('custom_design_switch',['design_file_value_div','custom_design_details','custom_design_price'],['custom_design_details_text','design_file'],'{{ $product->custom_design_option_price }}')" type="checkbox" role="switch" id="custom_design_switch">
    </div>
    <div class="row" id="design_file_value_div" style="display: none;">
        <div class="mb-4 col-md-5"  >
            <label for="design_file" class="form-label">Upload Your Design</label>
            <input type="file" accept="image/*" class="form-control" name="design_file" id="design_file" placeholder="Upload Your Design" value="" >
        </div>
    </div>

    <div class="row" id="custom_design_details" style="display: none;">
        <div class="mb-4 col-md-5"  >
            <label for="custom_design_details_text" class="form-label">Design Details</label>
            <textarea style="resize:none"   class="form-control" row="4" id="custom_design_details_text" placeholder="Design Details" name="custom_design_details_text"></textarea>
            
        </div>
    </div>
@endif