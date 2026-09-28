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
                    <button
                        type="button"
                        class="btn btn-outline-light"
                        data-bs-toggle="modal"
                        data-bs-target="#offerRegistrationModal">
                        Đăng ký
                    </button>
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
                <div class="mt-3">
                    <iframe
                        src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fussinavietnam%2F&tabs=&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true"
                        width="340"
                        height="300"
                        style="border:none;overflow:hidden;max-width:100%"
                        scrolling="no"
                        frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                        title="Facebook Ussina Vietnam"
                        loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>

    </div>


    <div class="border-top border-secondary">

        <div class="container py-3 text-center">
            <small a>
                © {{ date('Y') }}
                {{ setting('site_name') }}.
                Managed by Sagi
            </small>

        </div>

    </div>

</footer>

<button
    type="button"
    id="backToTop"
    class="btn btn-danger position-fixed bottom-0 end-0 m-3 rounded-circle d-none shadow"
    style="width: 48px; height: 48px; z-index: 1030;"
    aria-label="Lên đầu trang"
    title="Lên đầu trang">
    <span aria-hidden="true">&uarr;</span>
</button>

<div
    class="modal fade"
    id="offerRegistrationModal"
    tabindex="-1"
    aria-labelledby="offerRegistrationModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="offerRegistrationModalLabel">Đăng ký nhận ưu đãi</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Đóng"></button>
            </div>

            <form id="offerRegistrationForm" action="{{ route('leads.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div
                        id="offerRegistrationMessage"
                        class="alert d-none"
                        role="alert"></div>

                    <div class="mb-3">
                        <label class="form-label" for="offerName">Họ và tên</label>
                        <input class="form-control" id="offerName" name="name" type="text" maxlength="255" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="offerEmail">Email</label>
                        <input class="form-control" id="offerEmail" name="email" type="email" maxlength="255" required>
                    </div>

                    <div>
                        <label class="form-label" for="offerPhone">Số điện thoại</label>
                        <input class="form-control" id="offerPhone" name="phone" type="tel" maxlength="30">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-danger" id="offerRegistrationSubmit">Gửi đăng ký</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('offerRegistrationForm');
            const message = document.getElementById('offerRegistrationMessage');
            const submitButton = document.getElementById('offerRegistrationSubmit');
            const modalElement = document.getElementById('offerRegistrationModal');
            const backToTopButton = document.getElementById('backToTop');

            const updateBackToTopVisibility = () => {
                backToTopButton.classList.toggle('d-none', window.scrollY < 250);
            };

            window.addEventListener('scroll', updateBackToTopVisibility, { passive: true });
            updateBackToTopVisibility();

            backToTopButton.addEventListener('click', () => {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });

            form.addEventListener('submit', async (event) => {
                event.preventDefault();

                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                message.className = 'alert d-none';
                submitButton.disabled = true;
                submitButton.textContent = 'Đang gửi...';

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                        },
                        body: new FormData(form),
                    });
                    const data = await response.json();

                    if (!response.ok) {
                        const validationErrors = Object.values(data.errors ?? {}).flat();
                        throw new Error(validationErrors.join(' ') || 'Không thể gửi đăng ký.');
                    }

                    message.className = 'alert alert-success';
                    message.textContent = data.message;
                    form.reset();
                    form.classList.remove('was-validated');

                    window.setTimeout(() => {
                        bootstrap.Modal.getOrCreateInstance(modalElement).hide();
                        message.className = 'alert d-none';
                    }, 1800);
                } catch (error) {
                    message.className = 'alert alert-danger';
                    message.textContent = error.message;
                } finally {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Gửi đăng ký';
                }
            });
        });
    </script>
@endpush