<footer class="bg-dark text-white mt-5">

    <div class="container py-5">

        <div class="row g-4">

            {{-- Company --}}
            <div class="col-md-4">

                <h5>
                    {{ setting('site_name', 'Yakiniku King') }}
                    <h6>
                        <a class="navbar-brand fw-bold"
                        href="{{ url('/') }}">
                        <img src="{{ asset('yakiniku-king/logo1.png') }}" alt="Yakiniku King logo" width="none" height="75">
                        </a>
                    </h6>
                </h5>

                <p class="text-light">
                    {{ setting('footer_description') }}
                </p>

            </div>


            {{-- Contact --}}
            <div class="col-md-4">

                <h5>
                    Liên hệ
                </h5>

                <p>
                    Địa chỉ:
                    {{ setting('footer_address') }}
                </p>

                <p>
                    Hotline:
                    <a
                        href="tel:{{ setting('hotline') }}"
                        class="text-white">

                        {{ setting('hotline') }}

                    </a>
                </p>

                <p>
                    Email:
                    {{ setting('email') }}
                </p>

            </div>


            {{-- Social --}}
            <div class="col-md-4">

                <h5>
                    Theo dõi chúng tôi
                </h5>

                @if(setting('facebook_url'))
                    <a
                        href="{{ setting('facebook_url') }}"
                        target="_blank"
                        class="text-white me-3">

                        Facebook

                    </a>
                @endif


                @if(setting('instagram_url'))
                    <a
                        href="{{ setting('instagram_url') }}"
                        target="_blank"
                        class="text-white me-3">

                        Instagram

                    </a>
                @endif


                @if(setting('x_url'))
                    <a
                        href="{{ setting('x_url') }}"
                        target="_blank"
                        class="text-white">

                        X

                    </a>
                @endif

            </div>

        </div>

    </div>


    <div class="border-top border-secondary">

        <div class="container py-3">
            <small a>
                © {{ date('Y') }}
                {{ setting('site_name', 'Yakiniku King') }}.
                All rights reserved.
            </small>

        </div>

    </div>

</footer>