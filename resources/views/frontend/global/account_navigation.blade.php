<div class="dash-left">
    <h3>My Account <img src="{{ asset("images/nav-icon.png") }}" alt=""/></h3>
    <ul>
        <li><a href="{{ route("account") }}" class="@if (Route::currentRouteName() == 'account') active @endif">Dashboard</a></li>
        <li><a href="{{ route("orders") }}" class="@if (Route::currentRouteName() == 'orders') active @endif">Orders</a></li>
        <li><a href="{{ route("points") }}" class="@if (Route::currentRouteName() == 'points') active @endif">Points</a></li>
        <li><a href="{{ route("address") }}" class="@if (Route::currentRouteName() == 'address') active @endif">Addresses</a></li>
        <li><a href="{{ route("profile") }}" class="@if (Route::currentRouteName() == 'profile') active @endif">Account details</a></li>
        <li><a href="{{ route("wishlist") }}" class="@if (Route::currentRouteName() == 'wishlist') active @endif">Wishlist</a></li>
        <li><a href="#" class="logout-link">Logout</a></li>
    </ul>
</div>
