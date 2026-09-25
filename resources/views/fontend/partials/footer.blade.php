<footer class="bg-dark text-white mt-5">

    <div class="container py-5">

        <div class="row g-4">

            {{-- Company --}}
            <div class="col-md-4">
                <div>
                    <h5>
                        {{ setting('site_name') }}
                        <h6>
                            <a class="navbar-brand fw-bold"
                            href="{{ url('/') }}">
                            <img src="{{ asset('yakiniku-king/logo1.png') }}" alt="Yakiniku King logo" width="none" height="75">
                            </a>
                        </h6>
                    </h5>
                </div>
                <div class="textwidget">
                    <p>
                        {{ setting('footer_address') }}
                    </p>
                    <p>
                        Thời gian phục vụ từ 11h đến 23h.
                    </p>
                    <div>
                        <p>
                            <a
                                href="tel:{{ setting('hotline') }}"
                                class="text-white">
                                {{ setting('hotline_vn_jp') }}</a>
                            <br>
                            <a
                                href="tel:{{ setting('hotline') }}"
                                class="text-white">
                                {{ setting('hotline_en') }}</a>
                        </p>
                        <a
                                href="ussina.landmark81@ussinavietnam.com"
                                class="text-white">
                                {{ setting('email') }}
                        </a>
                    </div>
                </div>
                <div>
                <a href="https://www.facebook.com/ussinavietnam/">
                    <img src="{{ asset('yakiniku-king/logo-facebook.png') }}" width="50" height="50">
                </a>
                <a href="https://www.google.com/search?sxsrf=ACYBGNQPLfjiPbZ8qK6wTcU4GcFIQNJDsA%3A1568026028380&ei=rC12XazzFpDj-AaSx4_ADw&q=Ussina+Aging+Beef+%26+Bar+landmark+81&oq=Ussina+Aging+Beef+%26+Bar+landmark+81&gs_l=psy-ab.3..35i39l2j38.8560.16186..16983...2.2..0.180.1696.1j14......0....1..gws-wiz.......0i71j0j0i22i30j0i203j33i160j35i304i39.kzaVPMSedbs&ved=0ahUKEwis-a2TyMPkAhWQMd4KHZLjA_gQ4dUDCAs&uact=5#lrd=0x31752965c64ce237:0x8b8e188d592080ca,1,,">
                    <img src="{{ asset('yakiniku-king/gg-my-business.png') }}" width="45" height="45">
                </a>
                <a href="tripadvisor.com.vn/Restaurant_Review-g293925-d19647189-Reviews-Ussina_Aging_Beef_Bar-Ho_Chi_Minh_City.html">
                    <img src="{{ asset('yakiniku-king/tripadvisor-icon.png') }}" width="40" height="40">
                </a>
                </div>
                <div>
                    <p>
                        <a href="https://online.gov.vn/nen-tang/76be9e1f-3034-43bf-a3b6-193d8d81904a">
                            <img src="https://ussinavietnam.vn/wp-content/uploads/2020/08/dathongbaobct.png" width="200" height="70">
                        </a>
                    </p>
                </div>
            </div>


            {{-- Contact --}}
            <div class="col-md-4">

                <h5>
                    ĐĂNG KÝ NHẬN ƯU ĐÃI
                </h5>
                <p>
                    <a>
                        Đăng ký nhận thư điện tử từ chúng tôi để nhận ngay những ưu đãi tốt nhất
                    </a><br>
                    <div>
                    <a>Đăng ký</a>
                    </div>
                </p>
                <p>NHÀ HÀNG USSINA – VINCOM LANDMARK 81<br>
                Giấy CNĐKDN: 0312225168-002 – Ngày cấp: 01/04/2019<br>
                Cơ quan cấp: Phòng Đăng ký kinh doanh – Sở kế hoạch và Đầu tư TP.HCM<br>
                Địa chỉ đăng ký kinh doanh: Tầng L77, Tòa nhà Landmark 81, 720A Điện Biên Phủ, phường Thạnh Mỹ Tây, Thành phố Hồ Chí Minh, Việt Nam
                </p>
            </div>


            {{-- Social --}}
            <div class="col-md-4">
                <div>
                <h4>
                    CHỦ ĐỀ NỔI BẬT
                </h4>
                <p>
                    <a href="https://ussinavietnam.vn/tag/am-thuc-nhat-ban/" class="text-white">Ẩm thực Nhật Bản</a>,
                    <a href="https://ussinavietnam.vn/tag/nha-hang-nhat-ban/" class="text-white">Nhà hàng nhật bản</a>,
                    <a href="https://ussinavietnam.vn/tag/mon-an-nhat-ban/" class="text-white">Món ăn Nhật Bản</a>,
                    <a href="https://ussinavietnam.vn/tag/mon-ngon-nhat-ban/" class="text-white">món ngon nhật bản</a>,
                    <a href="https://ussinavietnam.vn/tag/nha-hang-co-view-dep/" class="text-white">nhà hàng có view đẹp</a>,
                    <a href="https://ussinavietnam.vn/tag/nha-hang-mon-nhat/" class="text-white">Nhà hàng món nhật</a>,
                    <a href="https://ussinavietnam.vn/tag/nha-hang-sang-trong/" class="text-white">Nhà hàng sang trọng</a>,
                    <a href="https://ussinavietnam.vn/tag/bo-wagyu/" class="text-white">Bò Wagyu</a>,
                    <a href="https://ussinavietnam.vn/tag/nha-hang-bo-wagyu/" class="text-white">Nhà hàng bò wagyu</a>,
                    <a href="https://ussinavietnam.vn/tag/thit-bo-wagyu-cao-cap/" class="text-white">Thịt bò Wagyu cao cấp</a>,...
                </p>
                </h4>
                </div>
            </div>

        </div>

    </div>


    <div class="border-top border-secondary">

        <div class="container py-3">
            <small a>
                © {{ date('2019') }}
                {{ setting('site_name') }}.
                Managed by V Lotus Holding
            </small>

        </div>

    </div>

</footer>