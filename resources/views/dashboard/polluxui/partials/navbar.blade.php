<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand brand-logo" href="index.html"><img src="{{ asset('polluxui/images/logo.svg') }}"
                    alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="index.html"><img
                    src="{{ asset('polluxui/images/logo-mini.svg') }}" alt="logo" /></a>
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="typcn typcn-th-menu"></span>
            </button>
        </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item ml-0">
                <h4 class="mb-0">Dashboard</h4>
            </li>
        </ul>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img src="{{ asset('images/default-profile.jpg') }}" alt="profile" />
                    <span class="nav-profile-name">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <form method="get" action="/profile/{{ Auth::user()->id }}/show">
                        @csrf
                        @method('get')
                        <button type="submit" class="dropdown-item btn btn-outline-dark">
                            <i class="typcn typcn-cog-outline btn-icon-prepend text-primary"></i>
                            Edit Profile
                            </span>
                        </button>

                    </form>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        @method('post')
                        <button type="submit" class="dropdown-item btn btn-outline-dark">
                            <i class="typcn typcn-eject btn-icon-prepend text-primary"></i>
                            Logout
                            </span>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>

