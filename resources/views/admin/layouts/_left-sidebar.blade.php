<!-- Sidebar scroll-->
<div class="scroll-sidebar">
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav">
        <ul id="sidebarnav">
            <li class="sidebar-item">
                <h4 class="sidebar-link  waves-effect waves-dark profile-dd text-center">
{{--                    <img src="{{ asset('assets/assets/images/users/1.jpg') }}" class="rounded-circle ml-2" width="30">--}}
                    <span>{{ Auth::user()->name }}</span>
                </h4>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link  waves-effect waves-dark" href="{{ route('dashboard') }}">
                    <i class="fa fa-table"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                    <span class="hide-menu">Settings</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('company-settings.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cards-variant"></i>
                            <span class="hide-menu">Company setting</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('customer.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">Customer</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="eco-products-edit.html" class="sidebar-link">
                            <i class="mdi mdi-cart-plus"></i>
                            <span class="hide-menu">Products Edit</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="eco-products-detail.html" class="sidebar-link">
                            <i class="mdi mdi-camera-burst"></i>
                            <span class="hide-menu">Product Details</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="eco-products-orders.html" class="sidebar-link">
                            <i class="mdi mdi-chart-pie"></i>
                            <span class="hide-menu">Product Orders</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="eco-products-checkout.html" class="sidebar-link">
                            <i class="mdi mdi-clipboard-check"></i>
                            <span class="hide-menu">Products Checkout</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
