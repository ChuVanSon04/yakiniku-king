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

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link"
                           href="{{ url('/') }}">
                            Trang chủ
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="#">
                            Menu
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="#">
                            Must Try
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="#">
                            Combo
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="#">
                            For Kids
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="#">
                            Khuyến mãi
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="#">
                            Recipes
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link"
                           href="#">
                            Bí kíp ăn ngon
                        </a>
                    </li>

                </ul>


                {{-- Book Now --}}
                <a href="#"
                   class="btn btn-danger">

                    Book Now

                </a>

            </div>

        </div>

    </nav>

</header>