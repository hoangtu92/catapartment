<div id="signin" class="overlay1">
    <a href="#" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <h4>{{ __("Sign IN") }}</h4>
        <hr>
        <form method="POST" id="sidebarLoginForm" action="{{ route('login') }}">
            @csrf
            <input type="hidden" id="mtoken" name="_g_token">
            <label>{{ __("Username or Email") }}*</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" required autocomplete="username" autofocus>
            <label>{{ __("Password") }}*</label>
            <input type="password" name="password" class="form-control" required>
            <button>{{ __("Login") }}</button>
        </form>
        <span><input type="checkbox" name="remember" form="sidebarLoginForm" {{ old('remember') ? 'checked' : '' }}> {{ __("Remember me") }} <a href="{{ url("password/reset") }}">{{ __("Lost your password?") }}</a></span>
        <h5 class="mb-3">{{ __("Or Login with") }}</h5>
        <a href="{{ url("/login/facebook") }}" class="login-with"><img src="{{ asset("images/facebook-login.jpg") }}" alt=""/></a>
        <a href="{{ url("/login/line") }}" class="login-with"><img src="{{ asset("images/line-login.jpg") }}" alt=""></a>
        <small>{{ __("By using social login. You agree to provide your email address that will only be used by us for further support") }}</small>
        <hr>
        <span class="text-center p-0"><img src="{{ asset("images/user-icon-new.jpg") }}" alt=""/></span>
        <span class="text-center"><span>{{ __("No account yet?") }}</span>
            <a href="{{ route("register") }}" class="create-new">{{ __("CREATE AN ACCOUNT") }}</a>
        </span>
    </div>
</div>

