@php
   $route = Route::current()->getName();
@endphp
<div class="col-md-3">
    <div class="dashboard-menu">
        <ul class="nav flex-column" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{($route == 'user.dashboard')?'active':''}}" href="{{Route('user.dashboard')}}"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{($route == 'user.order.page')?'active':''}}" href="{{Route('user.order.page')}}"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{($route == 'user.trackOrder.page')?'active':''}}" href="{{Route('user.trackOrder.page')}}"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{($route == 'user.billing&Shipping.page')?'active':''}}" href="{{Route('user.billing&Shipping.page')}}"><i class="fi-rs-marker mr-10"></i>My Address</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{($route == 'user.account.page')?'active':''}}" href="{{Route('user.account.page')}}"><i class="fi-rs-user mr-10"></i>Account details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{($route == 'user.changePassword.page')?'active':''}}" href="{{Route('user.changePassword.page')}}"><i class="fi-rs-user mr-10"></i>Change Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ Route('user.logout') }}"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
            </li>
        </ul>
    </div>
</div>