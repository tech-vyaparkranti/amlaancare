<div class="tab-pane fade" id="list-cashfree" role="tabpanel" aria-labelledby="list-home-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{route('admin.cashfree-setting.update', $cashFreeSetting->id??1)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Cash Free Status</label>
                    <select name="status" id="" class="form-control">
                        <option {{$cashFreeSetting?->status === 1 ? 'selected' : ''}} value="1">Enable</option>
                        <option {{$cashFreeSetting?->status === 0 ? 'selected' : ''}} value="0">Disable</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Account Mode</label>
                    <select name="mode" id="" class="form-control">
                        <option {{$cashFreeSetting?->mode == 'testing' ? 'selected' : ''}} value="testing">Testing</option>
                        <option {{$cashFreeSetting?->mode == 'live' ? 'selected' : ''}} value="live">Live</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Country Name</label>
                    <select name="country_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.country_list') as $country)
                            <option {{$country === $cashFreeSetting?->country_name ? 'selected' : ''}} value="{{$country}}">{{$country}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency Name</label>
                    <select name="currency_name" id="" class="form-control select2">
                        <option value="">Select</option>
                        @foreach (config('settings.currecy_list') as $key => $currency)
                            <option {{$currency === $cashFreeSetting?->currency_name ? 'selected' : ''}} value="{{$currency}}">{{$key}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Currency rate ( Per {{$settings->currency_name}} )</label>
                    <input type="text" class="form-control" name="currency_rate" value="{{$cashFreeSetting?->currency_rate}}">
                </div>
                <div class="form-group">
                    <label>Cashfree Client Id</label>
                    <input type="text" class="form-control" name="cash_free_client_id" value="{{$cashFreeSetting?->cash_free_client_id}}">
                </div>
                <div class="form-group">
                    <label>Cashfree Secret Key</label>
                    <input type="text" class="form-control" name="cash_free_secret_key" value="{{$cashFreeSetting?->cash_free_secret_key}}">
                </div>

                <button type="submit" class="btn btn-primary common_btn">Update</button>
            </form>
        </div>
    </div>
    </div>
