<div id="popup1" class="overlay">
    <div class="popup" style="background:url({{ asset("images/catpopup.jpg") }}) no-repeat; background-size:cover;">
        <a class="close" href="#">&times;</a>
        <div class="content nl-pop">

            <form method="post" action="{{ route("subscribe") }}" id="subscribeForm">
                @csrf
                <div class="nl-div">
                    <input type="hidden" name="action" value="normal">
                <input type="email" name="email" placeholder="{{ __("Your email address") }}"><button type="submit">訂閱</button>
            </div>
            <p><a href="{{ url("/login/facebook") }}"><img src="{{ asset("images/facebook-btn.png") }}" alt=""/></a></p>
            </form>
        </div>
    </div>
</div>

