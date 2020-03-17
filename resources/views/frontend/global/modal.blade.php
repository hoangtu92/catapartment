<div id="signin" class="overlay1">
    <a href="#" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="overlay-content">
        <h4>Sign IN</h4>
        <hr>
        <form method="POST" id="sidebarLoginForm" action="{{ route('login') }}">
            @csrf
            <label>Username or Email*</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" required autocomplete="username" autofocus>
            <label>Password*</label>
            <input type="password" name="password" class="form-control" required>
            <button type="submit">Login</button>
        </form>
        <span><input type="checkbox" name="remember" form="sidebarLoginForm" {{ old('remember') ? 'checked' : '' }}> Remember me <a href="#">Lost your password?</a></span>
        <h5 class="mb-3">Or Login with</h5>
        <a href="#" class="login-with"><img src="{{ asset("images/facebook-login.jpg") }}" alt=""/></a>
        <a href="#" class="login-with"><img src="{{ asset("images/line-login.jpg") }}" alt=""></a>
        <hr>
        <span class="text-center p-0"><img src="{{ asset("images/user-icon-new.jpg") }}" alt=""/></span>
        <span class="text-center"><span>No account yet?</span>
            <a href="{{ route("register") }}" class="create-new">CREATE AN ACCOUNT</a>
        </span>
    </div>
</div>
<div class="modal fade" id="errorModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-toggle="dismiss">x</button>
            </div>
            <div class="modal-body">
                <div class="message">

                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

