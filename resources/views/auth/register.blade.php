@extends('frontend.templates.default')

@section('content')
    <section class="inner-banner">
        <img src="{{ asset("images/catshop-banner08.jpg") }}" alt=""/>
    </section>
    <section class="mt-4 mb-4">
        <div class="container">
            <div class="row justify-content-center register">
                <div class="col-md-8 border-right">
                    <h2 class="text-center">{{ __('Register') }}</h2>

                    <form method="POST" action="{{ route('register') }}" id="protectedForm">
                        @csrf
                        <input type="hidden" id="token" name="_g_token">
                        <div class="form-group row">
                            <label for="username"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-8">
                                <input id="username" type="text"
                                       class="form-control @error('username') is-invalid @enderror" name="username"
                                       value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror" name="name"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror" name="email"
                                       value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="phone"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-8">
                                <input id="phone" type="text"
                                       class="form-control @error('phone') is-invalid @enderror" name="phone"
                                       value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-4">@error("_g_token")
                                <p><span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span></p>
                                @enderror</div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button data-sitekey="{{ env("g_site_key") }}"
                                        data-callback='onSubmitModal'
                                        data-action='submit' class="g-recaptcha btn-cat">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <h2>其他註冊方式</h2>
                    <a href="{{ url("/login/facebook") }}" class="login-with"><img src="{{ asset("images/facebook-login.jpg") }}" alt=""/></a>
                    <a href="{{ url("/login/line") }}" class="login-with"><img src="{{ asset("images/line-login.jpg") }}" alt=""></a>
                </div>
            </div>
        </div>
    </section>
@endsection
