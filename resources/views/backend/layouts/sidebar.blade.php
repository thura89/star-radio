<link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
<div class="mdk-drawer  js-mdk-drawer" id="default-drawer" data-align="start">
    <div class="mdk-drawer__content">
        <div class="sidebar sidebar-light sidebar-left sidebar-p-t" data-perfect-scrollbar>
            <div class="sidebar-heading">DashBoard</div>
            <ul class="sidebar-menu">
                <li class="sidebar-menu-item">
                    <a class="sidebar-menu-button" href="{{ route('admin.dashboard') }}">
                        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">home</i>
                        <span class="sidebar-menu-text">@lang('sidebar.dashboards')</span>
                    </a>
                </li>
                @if (Auth::check())
                    @if (auth()->user()->user_type == 1)
                        <li class="sidebar-menu-item">
                            <a class="sidebar-menu-button" href="{{ route('admin.users.index') }}">
                                <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">account_circle</i>
                                <span class="sidebar-menu-text">@lang('sidebar.users')</span>
                            </a>
                        </li>
                    @endif
                @endif

            </ul>
            <div class="sidebar-heading">Components</div>
            <div class="sidebar-block p-0 mb-0">
                <ul class="sidebar-menu" id="components_menu">
                    <li class="sidebar-menu-item @yield('program-active') @yield('category-active')">
                        <a class="sidebar-menu-button collapsed" data-toggle="collapse" href="#layouts_menu"
                            aria-expanded="false">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">folder_open</i>
                            <span class="sidebar-menu-text">@lang('sidebar.program')</span>
                            <span class="ml-auto sidebar-menu-toggle-icon"></span>
                        </a>
                        <ul class="sidebar-submenu collapse" id="layouts_menu" style="">
                            <li class="sidebar-menu-item @yield('category-active')">
                                <a class="sidebar-menu-button" href="{{ route('admin.categories.index') }}">
                                    <span class="sidebar-menu-text">@lang('sidebar.category')</span>
                                </a>
                            </li>
                            <li class="sidebar-menu-item @yield('program-active')">
                                <a class="sidebar-menu-button" href="{{ route('admin.programs.index') }}">
                                    <span class="sidebar-menu-text">@lang('sidebar.program')</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-menu-item @yield('audio-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.audios.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">audiotrack</i>
                            <span class="sidebar-menu-text">@lang('sidebar.play_audio')</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item @yield('news-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.news.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dns</i>
                            <span class="sidebar-menu-text">@lang('sidebar.news')</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item @yield('other_news-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.other_news.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dns</i>
                            <span class="sidebar-menu-text">@lang('sidebar.other_news')</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item @yield('events-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.events.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">event_available</i>
                            <span class="sidebar-menu-text">@lang('sidebar.events')</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item @yield('noble-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.nobles.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">library_books</i>
                            <span class="sidebar-menu-text">@lang('sidebar.noble')</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item @yield('ads-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.ads.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">book</i>
                            <span class="sidebar-menu-text">@lang('sidebar.ads')</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item @yield('slider-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.sliders.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">burst_mode</i>
                            <span class="sidebar-menu-text">@lang('sidebar.slider')</span>
                        </a>
                    </li>

                    <li class="sidebar-menu-item @yield('song_request-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.song_requests.index') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">chat</i>
                            <span class="sidebar-menu-text">@lang('sidebar.song_request') <span
                                    class="badge badge-primary ml-auto">NEW
                                    {{ Helper::songRequestCount() }}</span></span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item @yield('about-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.about') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">burst_mode</i>
                            <span class="sidebar-menu-text">@lang('sidebar.about')</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item @yield('contact-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.contact') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">burst_mode</i>
                            <span class="sidebar-menu-text">@lang('sidebar.contact')</span>
                        </a>
                    </li>
                    <li class="sidebar-menu-item @yield('daily_schedule-active')">
                        <a class="sidebar-menu-button" href="{{ route('admin.daily_schedule') }}">
                            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">burst_mode</i>
                            <span class="sidebar-menu-text">@lang('sidebar.daily_schedule')</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center sidebar-p-a border-bottom sidebar-account">
                <a href="profile.html" class="flex d-flex align-items-center text-underline-0 text-body">
                    <span class="avatar avatar-sm mr-2">
                        <img src="{{ Auth::user()->profile_img_path() }}" alt="avatar"
                            class="avatar-img rounded-circle">
                    </span>
                    <span class="flex d-flex flex-column">
                        <strong>{{ Auth::user()->name }}</strong>
                        <small class="text-muted text-uppercase">{{ Auth::user()->email }}</small>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
