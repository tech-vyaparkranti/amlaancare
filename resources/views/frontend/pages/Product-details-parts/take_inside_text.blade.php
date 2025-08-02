@if ($product->take_inside_text=='yes' && !empty($insideTextOptions))
    <div class="cstmname">
        <h5 class="w-100">Add Inside Side Text :</h5>
    </div>
    <div class="row ps-4">
        @foreach ($insideTextOptions as $key=>$item)
        <div class="form-check mb-1">
            <input class="form-check-input inside_text_option" id="id_{{$key}}" onclick="ShowMe('id_{{$key}}','{{$product->inside_text_price}}')"  name="inside_text_option" type="radio"  value="{{$item}}" />
            <label class="form-check-label" for="id_{{$key}}">
                {{$item}} (+ {{$settings->currency_icon ?? ''}} {{ $product->inside_text_price }})
            </label>
        </div>
        @endforeach
        <div class="form-check mb-1">
            <input class="form-check-input inside_text_option" id="id_none" onclick="ShowMe('id_none','{{-$product->inside_text_price}}')"  name="inside_text_option" type="radio"  value="none" />
            <label class="form-check-label" for="id_none">
                None
            </label>
        </div>
    </div>
    <div class="row hidden" id="inside_text_value_div" style="display: none;">
        <div class="mb-3 col-md-5"  >
            <label for="inside_text_value" class="form-label">Text</label>
            <input type="text" class="form-control" id="inside_text_value" name="inside_text_value" placeholder="Inside Text" value="" maxlength="20">
        </div>
    </div>
    <div class="row hidden" id="inside_date_value_div" style="display: none;">
        <div class="mb-3 col-md-5">
            <label for="inside_date_value" class="form-label">Date</label>
            <input type="text" class="form-control" id="inside_date_value" name="inside_date_value" placeholder="Date" value="" maxlength="20" >
        </div>
    </div>
    <div class="row hidden" id="inside_handwriting_value_div" style="display: none;">
        <div class="mb-3 col-md-5"  >
            <label for="inside_handwriting_value" class="form-label">Hand Writing</label>
            <input type="file" accept="image/*" class="form-control" id="inside_hand_writing_value" name="inside_hand_writing_value" placeholder="Hand Writing" value="" >
        </div>
    </div>
@endif