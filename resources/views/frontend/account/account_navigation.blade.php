<div class="dash-left">
    <h3>{{ __("My Account") }} <img src="{{ asset("images/nav-icon.png") }}" alt=""/></h3>
    <ul>
        <li><a href="{{ route("account") }}" class="@if (Route::currentRouteName() == 'account') active @endif">{{ __("Dashboard") }}</a></li>
        <li><a href="{{ route("orders") }}" class="@if (Route::currentRouteName() == 'orders') active @endif">{{ __("Orders") }}</a></li>
        <li><a href="{{ route("points") }}" class="@if (Route::currentRouteName() == 'points') active @endif">{{ __("Points") }}</a></li>
        <li><a href="{{ route("address") }}" class="@if (Route::currentRouteName() == 'address') active @endif">{{ __("Addresses") }}</a></li>
        <li><a href="{{ route("profile") }}" class="@if (Route::currentRouteName() == 'profile') active @endif">{{ __("Account details") }}</a></li>
        <li><a href="{{ route("change_password") }}" class="@if (Route::currentRouteName() == 'change_password') active @endif">{{ __("Change Password") }}</a></li>
        <li><a href="{{ route("wishlist") }}" class="@if (Route::currentRouteName() == 'wishlist') active @endif">{{ __("Wishlist") }}</a></li>
        <li><a href="#" class="logout-link">{{ __("Logout") }}</a></li>
    </ul>
</div>
