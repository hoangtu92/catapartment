<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="UTF-8">

    <title>{{ config('app.name', '貓公寓拼圖坊') }}</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset("favicon.ico") }}">
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
             page_id="{{ env("FACEBOOK_PAGE_ID") }}">
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
@if(Session::has('message'))
    <div class="modal fade" id="infoModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button data-toggle="dismiss">x</button>
                </div>
                <div class="modal-body">
                    <div class="message text-center">
                        {{ Session::get('message') }}
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            $("#infoModal").modal();
        })
    </script>
@endif

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
    });
</script>

<script>
    //SignIn Action
    function openNav() {
        document.getElementById("signin").style.width = "100%";
    }

    function closeNav() {
        document.getElementById("signin").style.width = "0%";
    }
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

@yield("scripts")
</body>
</html>
