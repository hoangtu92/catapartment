<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="UTF-8">

    <title>{{ config('app.name', '貓公寓拼圖坊') }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset("favicon.jpg") }}">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700,800&display=swap" rel="stylesheet">
    <!-- CSS Part Start -->
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
    <link rel="stylesheet" href="{{ asset("css/custom.css") }}">
    <link rel="stylesheet" href="{{ asset("css/animate.css") }}">
    <link rel="stylesheet" href="{{ asset("css/stellarnav.css") }}">
    <!-- Slider CSS -->
    <link rel="stylesheet" href="{{ asset("css/owl.carousel.css") }}">
    <link rel="stylesheet" href="{{ asset("css/owl.theme.css") }}">
    <!-- Tab CSS -->
    <link rel="stylesheet" href="{{ asset("css/easy-responsive-tabs.css") }}">

    @yield("stylesheet")

@if(!empty(env("FACEBOOK_PAGE_ID")))
    <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    xfbml            : true,
                    version          : 'v6.0'
                });
            };

            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>

        <!-- Your customer chat code -->
        <div class="fb-customerchat"
             attribution=setup_tool
             page_id="{{ env("FACEBOOK_PAGE_ID") }}"
             theme_color="#0084ff"
             logged_in_greeting="歡迎來到貓公寓拼圖坊！有什麼我可以為您服務的嗎？"
             logged_out_greeting="歡迎來到貓公寓拼圖坊！有什麼我可以為您服務的嗎？">
        </div>
    @endif
</head>

<body>
<!-- Start Header --->
@include("frontend.global.header")
<!-- End Header --->

<!--Begin Content-->
@yield("content")
<!--Begin Content-->

<!--Begin Footer-->
@include("frontend.global.footer")
<!--End Footer-->

<form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<!-- JS Part Start -->
<script src="{{ asset("js/jquery-2.1.3.min.js") }}"></script>
<script src="{{ asset("js/bootstrap.min.js") }}"></script>
<script src="{{ asset("js/viewportchecker.js") }}"></script>

<script src="{{ asset("js/owl.carousel.js") }}"></script>
<script src="{{ asset("js/jquery.easy-ticker.min.js") }}"></script>
<script src="{{ asset("js/custom.js") }}"></script>

<!--Begin Modal-->
@include("frontend.global.newsletter")
@include("frontend.global.popup_message")

@auth
    @else
@include("frontend.global.modal")
@endauth
<!--End Modal-->

<!-- Menu JS Part Start -->
<script type="text/javascript" src="{{ asset("js/stellarnav.min.js") }}"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        jQuery('.stellarnav').stellarNav({
            theme: 'light',
            breakpoint: 991,
            position: 'right',
        });

        jQuery('.overlay .close').click(function(){
            jQuery('.overlay').hide()
        });

        if(sessionStorage.subscribed !== "1" && localStorage.subscribed !== "1"){
            jQuery('.overlay').css('visibility','visible').css('opacity',1);
            sessionStorage.subscribed = '1';
        }
        $("#subscribeForm").submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route("subscribe") }}",
                type: "post",
                data: {
                    email: this.email.value,
                    _token: this._token.value
                },
                success: function () {
                    $("#infoModal .message").html("您已成功訂閱貓公寓電子報");
                    localStorage.subscribed = "1";
                },
                error: function(){
                    $("#infoModal .message").html("發生了一個錯誤。請稍後重試");
                },
                complete: function () {
                    $("#infoModal").modal("show");
                    jQuery('.overlay').hide()
                }
            });

            return false;

        })

    });
</script>

<script>
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    //SignIn Action
    function openNav() {
        document.getElementById("signin").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("signin").style.width = "0%";
    }
</script>

<script>
    $(document).ready(function ($) {
        $(".logout-link").click(function (e) {
            e.preventDefault();
            $("#frm-logout").submit();
        });

        $('.announcements').easyTicker({
            visible: 1,
            interval: 3000,
            mousePause: 1,
            height: 34,
        });
    })
</script>

<!-- Tab JS Part Start -->
<script src="{{ asset("js/easy-responsive-tabs.js") }}"></script>
<script>
    $(document).ready(function () {
        $('#horizontalTab').easyResponsiveTabs({
            type: 'default', //Types: default, vertical, accordion
            width: 'auto', //auto or any width like 600px
            fit: true,   // 100% fit in a container
            closed: 'accordion', // Start closed if in accordion view
            activate: function (event) { // Callback function if tab is switched
                var $tab = $(this);
                var $info = $('#tabInfo');
                var $name = $('span', $info);
                $name.text($tab.text());
                $info.show();
            }
        });
    });
</script>

@yield("scripts")
</body>
</html>
