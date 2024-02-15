<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    @if (session()->has('success'))
                        <div class="bg-warning p-2 rounded-3" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)"
                            x-show="show">
                            <p class="m-0">
                                {{ session('success') }}
                            </p>
                        </div>
                    @endif
                    <ul class="nav navbar-nav menu_nav ml-auto">

                        <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Shop</a>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        @if (session()->has('user_name'))
                            <li class="nav-item submenu">
                                <span class="nav-link">welcom, {{ session('user_name') }}</span>
                            </li>
                            <li class="nav-item submenu">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="nav-link">
                                        logout
                                    </button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item submenu dropdown">
                                <a class="nav-link" href="/registre">register</a>
                            </li>
                        @endif
                        @if (session()->has('user_role') && (session('user_role') == '3' || session('user_role') == '1'))
                            <li class="nav-item submenu dropdown">
                                <a href="/admin/dashboard" class="nav-link dropdown-toggle">Dashboard</a>
                            </li>
                        @endif


                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li>
                        <li class="nav-item">
                            <button class="mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" id="search" width="18" height="18"
                                    fill="currentColor" class="bi bi-search-heart" viewBox="0 0 16 16">
                                    <path
                                        d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018" />
                                    <path
                                        d="M13 6.5a6.47 6.47 0 0 1-1.258 3.844q.06.044.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11" />
                                </svg>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between" action="search_action" method="POST">
                @csrf
                <input type="text" name="search_title" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" id="close_search" width="18" height="18"
                        fill="currentColor" class="bi bi-search-heart" viewBox="0 0 16 16">
                        <path d="M6.5 4.482c1.664-1.673 5.825 1.254 0 5.018-5.825-3.764-1.664-6.69 0-5.018" />
                        <path
                            d="M13 6.5a6.47 6.47 0 0 1-1.258 3.844q.06.044.115.098l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1-.1-.115h.002A6.5 6.5 0 1 1 13 6.5M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</header>
