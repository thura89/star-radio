<div id="header" class="mdk-header js-mdk-header m-0" data-fixed>
    <div class="mdk-header__content">

        <div class="navbar navbar-expand-sm navbar-main navbar-dark bg-dark  pr-0" id="navbar" data-primary>
            <div class="container-fluid p-0">

                <!-- Navbar toggler -->

                <button class="navbar-toggler navbar-toggler-right d-block d-lg-none" type="button" data-toggle="sidebar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Brand -->
                <a href="index.html" class="navbar-brand ">

                    <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" fill="currentColor" style="width:20px;"
                        viewBox="0 0 40 40">
                        <path
                            d="M40 34.16666667c.01-3.21166667-2.58333333-5.82333334-5.795-5.835-1.94-.00666667-3.75666667.955-4.84166667 2.565-.10166666.155-.295.22333333-.47166666.16666666L11.94 25.66666667c-.19-.06-.31-.245-.28833333-.44333334.01-.07333333.015-.14833333.015-.22333333 0-.06833333-.005-.13833333-.01333334-.20666667-.02166666-.20166666.105-.39.3-.44666666l17.96-5.13c.13833334-.04.28666667-.005.39333334.09166666 1.05.97333334 2.42833333 1.51666667 3.86 1.525C37.38833333 20.83333333 40 18.22166667 40 15s-2.61166667-5.83333333-5.83333333-5.83333333C32.52 9.17166667 30.95333333 9.87833333 29.86 11.11c-.11.12166667-.28.16833333-.43666667.11833333L11.91 5.65333333c-.16-.05-.27333333-.19166666-.28833333-.35833333-.30333334-3.20166667-3.14333334-5.55166667-6.345-5.24833333S-.275 3.19.02833333 6.39166667c.28166667 2.99333333 2.79833334 5.28 5.805 5.275 1.64666667-.005 3.21333334-.71333334 4.30666667-1.945.11-.12166667.28-.16833334.43666667-.11833334l16.57 5.27166667c.22.06833333.34166666.30333333.27166666.52333333-.04166666.13333334-.14833333.23833334-.28333333.275L9.90333333 20.59666667c-.13333333.03833333-.275.00833333-.38166666-.08-1.03333334-.86833334-2.33833334-1.34666667-3.68833334-1.35C2.61166667 19.16666667 0 21.77833333 0 25s2.61166667 5.83333333 5.83333333 5.83333333c1.355-.005 2.665-.485 3.7-1.35833333.10833334-.09166667.25833334-.12.39333334-.07666667l18.29 5.81833334c.14.04333333.24666666.15666666.28.3.75666666 3.13166666 3.90833333 5.05666666 7.04 4.3C38.14833333 39.185 39.99 36.85333333 40 34.16666667z" />
                    </svg>

                    <span>StarRadio</span>
                </a>

                

                <ul class="nav navbar-nav d-none d-sm-flex navbar-height align-items-center">
                    <li class="nav-item mr-2">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ Str::upper(Session::get('locale')) }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              <a href="{{ url('/locale/en') }}" class="dropdown-item">EN</a>
                              <a href="{{ url('/locale/mm')}}" class="dropdown-item">MM</a>
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
                            <a class="dropdown-item" href="{{ route('admin.users.show', Auth::user()->id )}}"><i class="material-icons">account_circle</i>
                                My profile</a>
                            <a class="dropdown-item" href="{{ route('admin.users.edit', Auth::user()->id )}}"><i class="material-icons">edit</i> Edit
                                account</a>
                            <a class="dropdown-item" href="{{ route('admin.change_password')}}"><i class="material-icons">vpn_key</i> Change Password
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
