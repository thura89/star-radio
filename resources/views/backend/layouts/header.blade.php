<div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
    <div class="mdk-header__content">

        <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-dark  pr-0" id="navbar" data-primary>
            <div class="container-fluid p-0">

                <!-- Navbar toggler -->

                <button class="navbar-toggler navbar-toggler-right d-block d-lg-none" type="button" data-toggle="sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Brand -->
                <a href="{{ route('admin.dashboard')}}" class="navbar-brand ">

                    
                    <div class="star_logo"></div>
                    
                    <span class="ml-1">StarFM Radio</span>
                </a>



                <ul class="nav navbar-nav d-none d-sm-flex navbar-height align-items-center">
                    <li class="nav-item mr-2">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Str::upper(Session::get('locale')) }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a href="{{ url('/locale/en') }}" class="dropdown-item">EN</a>
                                <a href="{{ url('/locale/mm') }}" class="dropdown-item">MM</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown border-left">
                        <a href="#account_menu" class="nav-link dropdown-toggle" data-toggle="dropdown"
                            data-caret="false">
                            <span class="mr-1 d-flex-inline">
                                <span class="text-light">{{ Auth::user()->name }}</span>
                            </span>
                            <img src="{{ Auth::user()->profile_img_path() }}" class="rounded-circle" width="32"
                                alt="Frontted">
                        </a>
                        <div id="account_menu" class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-item-text dropdown-item-text--lh">
                                <div><strong>{{ Auth::user()->name }}</strong></div>
                                <div class="text-muted">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('admin.users.show', Auth::user()->id) }}"><i
                                    class="material-icons">account_circle</i>
                                My profile</a>
                            <a class="dropdown-item" href="{{ route('admin.users.edit', Auth::user()->id) }}"><i
                                    class="material-icons">edit</i> Edit
                                account</a>
                            <a class="dropdown-item" href="{{ route('admin.change_password') }}"><i
                                    class="material-icons">vpn_key</i> Change Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                <i class="material-icons">exit_to_app</i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>

            </div>
        </div>

    </div>
</div>
