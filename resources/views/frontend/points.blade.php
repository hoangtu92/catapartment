@extends("frontend.templates.default")
@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_account")) }}" alt=""/>
    </section>

    <section class="dashboard-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include("frontend.account.account_navigation")
                    <div class="dash-right">
                        <p><strong>親愛的{{ Auth::user()->name }}你好：</strong></p>
                        <p class="pl-3">你的消費已經累積 <input type="text" class="sp-am"  readonly value="{{ Auth::user()->points }}"> 積分</p>
                        <p class="pl-3">積分累積到10,000，立馬自動晉級為貓公寓拼圖坊的VIP，終身享有9折優惠，並優先參加換季出清競拍。</p>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>積分明細表（我們的積分不歸零，終身有效。）</p>
                                <div class="points-table">
                                    <table class="table full-width">
                                        <tbody>
                                        <tr>
                                            <th>消費日期</th>
                                            <th>購買項目</th>
                                            <th>購買金額</th>
                                            <th>積分</th>
                                        </tr>
                                        {{--<tr>
                                            <td>2018/10/10</td>
                                            <td>人魚公主3000片拼圖</td>
                                            <td>3,000</td>
                                            <td>3,000</td>
                                        </tr>--}}

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
