@if ($product->gift_wrap_option=='yes')
    <div class="cstmname mb-2">
        <h5 class="w-100" for="gift_wrap_option">Add Gift Wrap : <span style="display: none;" id="gift_wrap_option_price">(+ {{$settings->currency_icon ?? ''}} {{ $product->gift_wrap_option_price }})</span></h5>
    </div>    
    <div class="form-check form-switch">
        <input class="form-check-input" name="gift_wrap_option" value="yes" onclick="showDiv('gift_wrap_option_switch',['gift_note_text_div','gift_wrap_option_price'],['gift_note_text'],'{{ $product->gift_wrap_option_price }}')" type="checkbox" role="switch" id="gift_wrap_option_switch">
    </div>
    <div class="row" id="gift_note_text_div" style="display: none;">
        <div class="mb-4 col-md-5"  >
            <label for="custom_design_details_text" class="form-label">Gift Note</label>
            <textarea style="resize:none"   class="form-control" row="4" id="gift_note_text" placeholder="Gift Note" name="gift_note_text"></textarea>
            
        </div>
    </div>
@endif