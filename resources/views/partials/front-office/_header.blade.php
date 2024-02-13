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

                        <li class="nav-item"><a class="nav-link" href="home">Home</a></li>
                        <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Shop</a>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <a class="nav-link" href="login">Login</a>
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
                                <a class="nav-link" href="registre">register</a>
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
                            <button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>
