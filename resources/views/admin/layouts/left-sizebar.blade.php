<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
                        <i class="mdi mdi-av-timer"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('profiles.show')}}" aria-expanded="false">
                        <i class="fas fa-address-card"></i>
                        <span class="hide-menu">Thông tin cá nhân</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('users')}}" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span class="hide-menu">Quản lí người dùng</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('category.index')}}" aria-expanded="false">
                        <i class="fab fa-apple"></i>
                        <span class="hide-menu">Danh mục sản phẩm</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('products.index')}}" aria-expanded="false">
                        <i class="fas fa-desktop"></i>
                        <span class="hide-menu">Sản phẩm</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('voucher.index')}}" aria-expanded="false">
                        <i class="fas fa-gift"></i>
                        <span class="hide-menu">Khuyến mãi</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.orderpending')}}" aria-expanded="false">
                        <i class="fas fa-shipping-fast"></i>
                        <span class="hide-menu">Quản lí đơn hàng</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
