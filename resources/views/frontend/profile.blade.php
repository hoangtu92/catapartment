@extends("frontend.templates.default")

@section("stylesheet")
    <!--Price Rengebar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
          media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ asset("css/price_range_style.css") }}"/>
@endsection

@section("content")

    <section class="inner-banner">
        <img src="{{ asset(\Backpack\Settings\app\Models\Setting::get("banner_account")) }}" alt=""/>
    </section>

    <section class="dashboard-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include("frontend.global.account_navigation")
                    <div class="dash-right">
                        <p>完成資料填寫可獲得回饋點數5點</p>
                        <form method="post" action="{{ route("update_user") }}">
                            <input type="hidden" name="action" value="update_profile">
                            @csrf
                            <table class="full-width user-profile-table">
                                <tr>
                                    <td>
                                        <label for="name">{{ __("Name") }}<sup>*</sup></label>
                                        <input id="name" type="text" value="{{ Auth::user()->name }}" class="form-control" name="name" required>
                                    </td>
                                    <td>
                                        <label for="email">{{ __("Email") }}<sup>*</sup></label>
                                        <input id="email" type="email" value="{{ Auth::user()->email }}" class="form-control" name="email" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="phone">{{ __("Phone") }}<sup>*</sup></label>
                                        <input id="phone" type="tel" class="form-control" value="{{ Auth::user()->phone }}" name="phone" required>
                                    </td>
                                    <td>
                                        <label for="birthday">{{ __("Birthday") }}</label>
                                        <input id="birthday" type="date" class="form-control" value="{{ Auth::user()->birthday }}" name="birthday">
                                    </td>
                                    {{--<td>

                                        <label>{{ __("Gender") }}<sup>*</sup></label><br>

                                        <label for="male" class="radio-inline">
                                            <input type="radio" id="male" value="male" @if(Auth::user()->gender == "male") checked @endif name="gender"> {{ __("Male") }}</label>
&nbsp;
                                        <label class="radio-inline" for="female">
                                            <input id="female" type="radio" value="female" @if(Auth::user()->gender == "female") checked @endif name="gender"> {{ __("Female") }}</label>

                                    </td>--}}
                                </tr>

                                <tr>
                                    <td>
                                        <label for="address">{{ __("Address") }}</label>
                                        <input id="address" type="text" class="form-control" value="{{ Auth::user()->address }}" name="address">
                                    </td>
                                    <td>
                                        <label for="zipcode">{{ __("Zip Code") }}</label>
                                        <input id="zipcode" type="text" class="form-control" value="{{ Auth::user()->zipcode }}" name="zipcode">
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                    </td>
                                    <td>
                                        <input class="btn-cat pull-right" type="submit" value="{{ __("Save") }}">
                                    </td>
                                </tr>

                            </table>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@section("scripts")
    <!-- Price Rengebar JS Part Start -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
            type="text/javascript"></script>
    <script src="{{ asset("js/price_range_script.js") }}" type="text/javascript"></script>

@endsection
