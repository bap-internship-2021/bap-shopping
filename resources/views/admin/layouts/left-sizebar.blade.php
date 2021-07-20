<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('dashboard')}}" aria-expanded="false">
                        <i class="mdi mdi-av-timer"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('admin.profile')}}" aria-expanded="false">
                        <i class="fas fa-address-card"></i>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('users')}}" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('category.index')}}" aria-expanded="false">
                        <i class="fab fa-apple"></i>
                        <span class="hide-menu">Category</span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('products.index')}}" aria-expanded="false">
                        <i class="fas fa-desktop"></i>
                        <span class="hide-menu">Product</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{route('sale.index')}}" aria-expanded="false">
                        <i class="fas fa-gift"></i>
                        <span class="hide-menu">Sales</span>
                    </a>
                </li>
                
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="" aria-expanded="false">
                        <i class="mdi mdi-alert-outline"></i>
                        <span class="hide-menu">404</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>