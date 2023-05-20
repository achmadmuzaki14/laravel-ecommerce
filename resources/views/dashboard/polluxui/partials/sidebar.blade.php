<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="/products">
                <i class="typcn typcn-shopping-bag menu-icon"></i>
                <span class="menu-title">Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/myorders">
                <i class="typcn typcn-th-large-outline menu-icon"></i>
                <span class="menu-title">My Orders</span>
            </a>
        </li>

        @if (Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="typcn typcn-device-desktop menu-icon"></i>
                    <span class="menu-title">Admin Panel</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="/product">Manage Product</a></li>
                        <li class="nav-item"> <a class="nav-link" href="/category">Manage Category</a></li>
                    </ul>
                </div>
            </li>
        @else
        @endif
    </ul>
</nav>
