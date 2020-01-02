@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:2%">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <div class="form-group row">
                                <label for="company-name" class="col-md-4 col-form-label text-md-right">{{ __('Company Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="company-name" type="text" class="form-control @error('company-name') is-invalid @enderror" name="company-name" value="{{ old('company-name') }}" autocomplete="company-name" autofocus>
    
                                    @error('company-name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Contact Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="user-name" class="col-md-4 col-form-label text-md-right">{{ __('User Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="user-name" type="text" class="form-control @error('user-name') is-invalid @enderror" name="user-name" value="{{ old('user-name') }}" autocomplete="user-name" autofocus>
    
                                    @error('user-name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="street-address" class="col-md-4 col-form-label text-md-right">{{ __('Street Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="street-address" type="text" class="form-control" name="street_address" autocomplete="street-address">
                                </div>
                        </div>

                        <div class="form-group row">
                                <label for="city-address" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
    
                                <div class="col-md-6">
                                    <input id="city-address" type="text" class="form-control" name="city_address" autocomplete="city-address">
                                </div>
                        </div>

                        <div class="form-group row">
                                <label for="state-address" class="col-md-4 col-form-label text-md-right">{{ __('State') }}</label>
    
                                <div class="col-md-6">
                                    <input id="state-address" type="text" class="form-control" name="state_address" autocomplete="state-address">
                                </div>
                        </div>

                        <div class="form-group row">
                                <label for="zip-address" class="col-md-4 col-form-label text-md-right">{{ __('Zip') }}</label>
    
                                <div class="col-md-6">
                                    <input id="zip-address" type="text" class="form-control" name="zip_address" autocomplete="zip-address">
                                </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                        </div>


                    <div class="form-group row justify-content-center">
                        <div class="col-md-6">
                                <div class="g-recaptcha" data-sitekey="{{ env('CAPTCHA_SITE_KEY')}}"></div>
                                @error('g-recaptcha-response')
                                    <span class="invalid-feedback" style="display: block">
                                        <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                                    </span>
                                @enderror
                        </div>

                    </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
