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
                    <a href="#" class="@yield('dashboard-active')">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Dashboards
                    </a>
                </li>
                <li class="app-sidebar__heading">Properties Management</li>
                <li>
                    <a href="{{ route('agent.property.index')}}" class="@yield('property-active')">
                        <i class="metismenu-icon pe-7s-menu"></i>
                        Properties
                    </a>
                    <a href="{{ route('agent.expired_property.index')}}" class="@yield('expired_property-active')">
                        <i class="metismenu-icon pe-7s-menu"></i>
                        Expired Property
                    </a>
                    <a href="{{ route('agent.want2buyrent.index')}}" class="@yield('want2buyrent-active')">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Want2BuyRent
                    </a>
                </li>
                <li class="app-sidebar__heading">Settings</li>
                <li>
                    <a href="{{ route('agent.profile')}}" class="@yield('profile-active')">
                        <i class="metismenu-icon pe-7s-id"></i>
                        Profile
                    </a>
                    <a href="{{ route('agent.logout') }}"
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