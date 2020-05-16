<footer>
    <div class="footer-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-4 flogo"><img src="{{ asset("images/footer-logo.jpg") }}" alt=""/></div>
                        <div class="col-md-8">
                            <h5>{{ \Backpack\Settings\app\Models\Setting::get("footer_about") }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>貓公寓拼圖坊聯絡資訊</h3>
                            <h4>營業時間：{{ \Backpack\Settings\app\Models\Setting::get("footer_working_hour") }} <br>
                                地址：<a href="https://www.google.com/maps/search/{{ \Backpack\Settings\app\Models\Setting::get("footer_address") }}/@22.6391436,120.3184605,17z/data=!3m1!4b1" target="_blank"> {{ \Backpack\Settings\app\Models\Setting::get("footer_address") }}</a><br>
                                電話：{{ \Backpack\Settings\app\Models\Setting::get("footer_phone") }}</h4>
                        </div>
                        <div class="col-md-6 qr-code"><img src="{{ asset("images/facebook-qr.jpg") }}" alt=""/> <img
                                src="{{ asset("images/instagram-qr.jpg") }}" alt=""/> <img
                                src="{{ asset("images/line-qr.jpg") }}" alt=""/></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">{{ __("Copyright © 2020 Cats Apartment. All Rights Reserved.") }} <a class="pull-right" href="{{ route("page", ["privacy-policy"]) }}">隱私權政策</a> </div>


</footer>
