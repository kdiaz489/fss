
<div class="container container-signup" style=" margin-top: 2%">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" id="new-pass-email-form" action="{{ route('password.email') }}">
                

                <div class="form-group row justify-content-md-center">
                    
                    <div class="col-md-12">
                        <h5 class="mb-4">E-Mail</h5>
                        <input id="email2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" style="border-style: none none solid none;" autofocus placeholder="Account e-mail address">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0 justify-content-md-center">
                        <button type="submit" id="newpass-submit" class="btn btn-link m-auto" style="font-weight:700;">
                            {{ __('Send Reset Link') }}
                        </button>
                </div>
                @csrf
            </form>

      </div>
    