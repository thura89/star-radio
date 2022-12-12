
<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                    data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button"
                class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboards</li>
                <li>
                    <a href="{{ route('admin.dashboard')}}" class="@yield('dashboard-active')">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboards
                    </a>
                </li>
                <li class="app-sidebar__heading">User Management</li>
                <li>
                    <a href="{{ route('admin.admin-user.index')}}" class="@yield('admin-user-active')">
                        <i class="metismenu-icon pe-7s-diamond"></i>
                        Admin Management
                    </a>
                    <a href="{{ route('admin.agent-user.index')}}" class="@yield('agent-user-active')">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Agent Management
                    </a>
                    <a href="{{ route('admin.developer-user.index')}}" class="@yield('developer-user-active')">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Developer Management
                    </a>
                    <a href="{{ route('admin.dump-user.index')}}" class="@yield('dump-user-active')">
                        <i class="metismenu-icon pe-7s-user"></i>
                        Dump/User Management
                    </a>
                  
                </li>
                <li class="app-sidebar__heading">Properties Management</li>
                <li>
                    <a href="{{ route('admin.property.index')}}" class="@yield('property-active')">
                        <i class="metismenu-icon pe-7s-menu"></i>
                        Properties
                    </a>
                    <a href="{{ route('admin.new_project.index')}}" class="@yield('newproject-active')">
                        <i class="metismenu-icon pe-7s-portfolio"></i>
                        Developer New Properties
                    </a>
                    <a href="{{ route('admin.want2buyrent.index')}}" class="@yield('want2buyrent-active')">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Want2BuyRent
                    </a>
                    <a href="{{ route('admin.expired_property.index')}}" class="@yield('expired_property-active')">
                        <i class="metismenu-icon pe-7s-menu"></i>
                        Expired Property
                    </a>
                </li>
                <li class="app-sidebar__heading">News</li>
                <li>
                    <a href="{{ route('admin.news.index')}}" class="@yield('news-active')">
                        <i class="metismenu-icon pe-7s-news-paper">
                        </i>News Management
                    </a>
                </li>
                <li class="app-sidebar__heading">Slider</li>
                <li>
                    <a href="{{ route('admin.slider.index')}}" class="@yield('slider-active')">
                        <i class="metismenu-icon pe-7s-news-paper">
                        </i>Slider Management
                    </a>
                </li>
                <li class="app-sidebar__heading">Settings</li>
                <li>
                    <a href="{{ route('admin.profile')}}" class="@yield('profile-active')">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Profile
                    </a>
                    <a href="{{ route('admin.logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="metismenu-icon pe-7s-power">
                        </i>Logout
                    </a>
                </li>
              
            </ul>
        </div>
    </div>
</div>