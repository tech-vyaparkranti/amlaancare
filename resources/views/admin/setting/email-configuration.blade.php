<div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
    <div class="card border">
        <div class="card-body">
            @if(is_null($emailSettings))
                <div class="alert alert-warning">
                    No email settings found. Please enter and save to create new settings.
                </div>
            @endif

            <form action="{{ route('admin.email-setting-update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $emailSettings->email ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label>Mail Host</label>
                    <input type="text" class="form-control" name="host" value="{{ $emailSettings->host ?? '' }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SMTP Username</label>
                            <input type="text" class="form-control" name="username" value="{{ $emailSettings->username ?? '' }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>SMTP Password</label>
                            <input type="password" class="form-control" name="password" value="{{ $emailSettings->password ?? '' }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Port</label>
                            <input type="text" class="form-control" name="port" value="{{ $emailSettings->port ?? '' }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Encryption</label>
                            <select name="encryption" class="form-control" required>
                                <option value="tls" {{ ($emailSettings->encryption ?? '') === 'tls' ? 'selected' : '' }}>TLS</option>
                                <option value="ssl" {{ ($emailSettings->encryption ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary common_btn mt-3">Update</button>
            </form>
        </div>
    </div>
</div>
