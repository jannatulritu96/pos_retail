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
                    <i class="fa fa-cubes"></i>
                    <span class="hide-menu">Inventory</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('purchases.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">Purchase</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('stock_in.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">Stock In (Receive)</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a href="{{ route('stock_return.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">Return to Supplier</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                    <a href="{{ route('supplier_payment.index') }}" class="sidebar-link">
                        <i class="mdi mdi-cart"></i>
                        <span class="hide-menu">Supplier Payment</span>
                    </a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                    <i class="fa fa-book"></i>
                    <span class="hide-menu">Expense</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('expense.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">Expense</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('expense_category.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">Expense Category</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('expense.search-report') }}" class="sidebar-link">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">Expense Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                    <i class="fas fa-gift"></i>
                    <span class="hide-menu">Products</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('category.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">Category</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('product.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">Product</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                    <span class="hide-menu">Settings</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                    <li class="sidebar-item">
                        <a href="{{ route('setting') }}" class="sidebar-link">
                            <i class="mdi mdi-cards-variant"></i>
                            <span class="hide-menu">Company setting</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('customer.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cart"></i>
                            <span class="hide-menu">Customers</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('supplier.index') }}" class="sidebar-link">
                            <i class="mdi mdi-cart-plus"></i>
                            <span class="hide-menu">Suppliers</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('outlet.index') }}" class="sidebar-link">
                            <i class="mdi mdi-camera-burst"></i>
                            <span class="hide-menu">Outlets</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('payment.index') }}" class="sidebar-link">
                            <i class="mdi mdi-chart-pie"></i>
                            <span class="hide-menu">Payment Method</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('unit.index') }}" class="sidebar-link">
                            <i class="mdi mdi-clipboard-check"></i>
                            <span class="hide-menu">Units</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
