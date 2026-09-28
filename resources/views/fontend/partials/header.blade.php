<header>

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">

        <div class="container">

            {{-- Logo --}}
            <a class="navbar-brand fw-bold"
               href="{{ url('/') }}">
                <img src="{{ asset('yakiniku-king/logo.png') }}" alt="Yakiniku King logo" width="none" height="80">
            </a>


            {{-- Mobile button --}}
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#frontendNavbar">

                <span class="navbar-toggler-icon"></span>

            </button>


            {{-- Menu --}}
            <div class="collapse navbar-collapse"
                 id="frontendNavbar">

                <ul class="navbar-nav align-items-right ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ url('/') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           href="{{ route('menu.index') }}"
                           id="menuDropdown"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Menu
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="menuDropdown">
                            <li><a class="dropdown-item" href="{{ route('menu.must-try') }}">Must Try</a></li>
                            <li><a class="dropdown-item" href="{{ route('menu.combos') }}">Combo</a></li>
                            <li><a class="dropdown-item" href="{{ route('menu.for-kids') }}">For Kids</a></li>
                            <li><a class="dropdown-item" href="{{ route('menu.promotions') }}">Khuyến Mãi</a></li>
                            <li><a class="dropdown-item" href="{{ route('menu.index') }}">Our Menu</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="#">
                            CTKM
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"
                           href="#"
                           id="ourSecretDropdown"
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                            Our Secret
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="ourSecretDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('secret.recipes') }}">
                                    Recipes
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('secret.tips') }}">
                                    Bí kíp ăn ngon
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ route('about') }}">
                            About Us
                        </a>
                    </li>
                </ul>
            </div>

        </div>

    </nav>

</header>