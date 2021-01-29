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
                        <p class="pl-3">購買超過4000元即成為VIP會員，VIP會員可享有本站8折再9折的價格（72折），需新增身分證後五碼驗證。</p>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>積分明細表（我們的積分不歸零，終身有效。）</p>
                                <div class="points-table">
                                    <table class="table full-width">
                                        <tbody>
                                        <tr>
                                            <th>消費日期</th>
                                            <th>項目</th>
                                            {{--<th>購買金額</th>--}}
                                            <th>積分</th>
                                        </tr>



                                        @if($current_user != null && $current_user->points_log()->count() > 0)

                                            @foreach($current_user->points_log as $point)
                                                <tr>
                                                    <td>{{ $point->created_at->format("Y-m-d") }}</td>
                                                    <td>{!! $point->notes !!}</td>
                                                    <td>{{ $point->amount }}</td>
                                                </tr>
                                                @endforeach

                                            @else
                                            <tr><td colspan="3" class="text-center">目前尚無紀錄</td></tr>
                                            @endif


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
