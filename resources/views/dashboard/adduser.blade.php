
@if( !session()->has('message'))
<div class="container container-signup" style=" margin-top: 2%">
        <form method="POST" id="add-user-form" action="{{ route('register') }}">
                
                <div class="form-group row">
                        <div class="col-md-6">
                            <input id="company-name-admin" type="text" class="form-control @error('company-name') is-invalid @enderror" name="company-name" value="{{ old('company-name') }}" required autocomplete="company-name" autofocus placeholder="Company Name">

                            @error('company-name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                                <input id="name-admin" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Contact Name">
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>

                <div class="form-group row">

                    <div class="col-md-6">
                            <input id="user-name-admin" type="text" class="form-control @error('user-name') is-invalid @enderror" name="user-name" value="{{ old('user-name') }}" required autocomplete="user-name" autofocus placeholder="Username">

                            @error('user-name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                                <input id="email-admin" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail">
        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                </div>


                <div class="form-group row">

                        <div class="col-md-6">
                            <input id="street-address-admin" type="text" class="form-control" name="street_address" required autocomplete="street-address" placeholder="Street Address">
                        </div>

                        <div class="col-md-6">
                            <input id="city-address-admin" type="text" class="form-control" name="city_address" required autocomplete="city-address" placeholder="City">
                        </div>
                </div>


                <div class="form-group row">

                        <div class="col-md-6">
                            <input id="state-address-admin" type="text" class="form-control" name="state_address" required autocomplete="state-address" placeholder="State">
                        </div>
                        <div class="col-md-6">
                            <input id="zip-address-admin" type="text" class="form-control" name="zip_address" required autocomplete="zip-address" placeholder="Zip/Postal">
                        </div>

                </div>

                <div class="form-group row">

                    <div class="col-md-6">
                        <input id="password-admin" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <input id="password-confirm-admin" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <button type="submit" id="adduser-submit" class="adduser-submit btn btn-link font-weight-bold">
                            {{ __('Add User') }}
                        </button>
                    </div>
                </div>
                @csrf
            </form>
      </div>
    @endif
