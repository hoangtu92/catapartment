<div id="popup1" class="overlay">
    <div class="popup" style="max-width:600px; background:url({{ asset("images/pop-bg.jpg") }}) no-repeat; background-size:cover;">
        <a class="close" href="#">&times;</a>
        <div class="content nl-pop">
            <h3>Hello, 愛拼圖的朋友們</h3>
            <p>歡迎註冊成為貓公寓的會員，全球最新的拼圖
                情報，燒燙燙送到你手裡喔！</p>
            <form method="post" action="{{ route("subscribe") }}" id="subscribeForm">
                @csrf
                <div class="nl-div">
                    <input type="hidden" name="action" value="normal">
                <input type="email" name="email" placeholder="{{ __("Your email address") }}"><button type="submit">加入</button>
            </div>
            <p><a href="#"><img src="{{ asset("images/facebook-btn.png") }}" alt=""/></a></p>
            </form>
        </div>
    </div>
</div>
