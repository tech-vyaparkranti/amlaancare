@if ($product->rush_service=='yes')
    <div class="cstmname mb-2">
        <h5 class="w-100" for="rush_service_option_switch">Rush Service : <span style="display: none;" id="rush_service_option_price">(+ {{$settings->currency_icon ?? ''}} {{ $product->rush_service_price }})</span></h5>
    </div>
    <div class="form-check form-switch">
        <input class="form-check-input" onclick="showDiv('rush_service_option_switch',['rush_service_text_div','rush_service_option_price'],['rush_service_date'],'{{ $product->rush_service_price }}')" type="checkbox" value="yes" name="rush_service" role="switch" id="rush_service_option_switch">
    </div>
    <div class="row" id="rush_service_text_div" style="display: none;">
        <div class="mb-4 col-md-5"  >
            <label for="rush_service_date" class="form-label">Delivery Date</label>
            <input class="form-control" min="{{ date('Y-m-d')}}" type="date" id="rush_service_date" placeholder="Delivery Date" name="rush_service_date">

        </div>
    </div>
@endif
