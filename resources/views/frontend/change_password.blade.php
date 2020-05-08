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
                        <p>{{ __("Change Password") }}</p>
                        <form method="post" action="{{ route("change_password") }}">
                            @csrf
                            <table class="full-width user-profile-table">
                                <tr>
                                    <td>
                                        <label for="old_password">{{ __("Old Password") }}<sup>*</sup></label>
                                        <input id="old_password" type="password" value="" class="form-control" name="old_password" required>
                                        @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <label for="password">{{ __("Password") }}<sup>*</sup></label>
                                        <input id="password" type="password" value="" class="form-control" name="password" required>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </td>

                                </tr>

                                <tr>
                                    <td>
                                        <label for="password_confirmation">{{ __("Password Confirmation") }}<sup>*</sup></label>
                                        <input id="password_confirmation" type="password" value="" class="form-control" name="password_cofirmation" required>
                                        @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </td>
                                </tr>

                                <tr>
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
