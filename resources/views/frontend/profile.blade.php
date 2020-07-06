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
                        <p>完成資料填寫可獲得回饋點數5點</p>
                        <form method="post" action="{{ route("update_user") }}">
                            <input type="hidden" name="action" value="update_profile">
                            @csrf
                            <table class="full-width user-profile-table">

                                @if(Auth::user()->is_vip && Auth::user()->vip_code == null)
                                <tr>
                                    <td>
                                        <label for="vip_code">VIP身分證驗證</label>
                                        <input id="vip_code" type="text" name="vip_code" class="form-control">
                                    </td>
                                </tr>
                                @endif
                                <tr>
                                    <td>
                                        <label for="name">{{ __("Name") }}<sup>*</sup></label>
                                        <input id="name" type="text" value="{{ Auth::user()->name }}" class="form-control" name="name" required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </td>
                                    <td>
                                        <label for="email">{{ __("Email") }}<sup>*</sup></label>
                                        <input id="email" type="email" value="{{ Auth::user()->email }}" class="form-control" name="email" required>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
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
