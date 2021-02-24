<footer>
    <div class="footer-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-md-4 flogo"><img src="{{ asset("images/footer-logo.jpg") }}" alt=""/></div>
                        <div class="col-md-8">
                            <h5>{{ \Backpack\Settings\app\Models\Setting::get("footer_about") }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row">
                        <div class="col-md-5">
                            <h3>貓公寓拼圖坊聯絡資訊</h3>
                            <h4>營業時間：{{ \Backpack\Settings\app\Models\Setting::get("footer_working_hour") }} <br>
                                有光店：高雄市三民區有光路172號<br>
                                科工店：高雄市三民區平等路41號1樓<br>
                                電話：{{ \Backpack\Settings\app\Models\Setting::get("footer_phone") }}<br></h4>



                        </div>
                        <div class="col-md-7 qr-code"><img src="{{ asset("images/facebook-qr.jpg") }}" alt=""/> <img
                                src="{{ asset("images/instagram-qr.jpg") }}" alt=""/> <img
                                src="{{ asset("images/line-qr.jpg") }}" alt=""/></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">{{ __("Copyright © 2020 Cats Apartment. All Rights Reserved.") }} <a class="pull-right" href="{{ route("page", ["privacy-policy"]) }}">隱私權政策</a> </div>


</footer>
