@extends('fontend.layouts.app')

@section('title', 'Đặt bàn')

@push('styles')
    <style>
        .booking-page {
            min-height: calc(100svh - 80px);
            display: flex;
            align-items: center;
            padding-block: clamp(2.5rem, 6vw, 5rem);
            background: linear-gradient(90deg, rgb(22 18 15 / 76%), rgb(22 18 15 / 28%)), url('{{ asset('yakiniku-king/gg-map.jpg') }}') center / cover;
        }

        .booking-intro {
            max-width: 390px;
            color: #fff;
        }

        .booking-eyebrow {
            color: #e6b86a;
            font-size: .75rem;
            font-weight: 700;
            letter-spacing: .16em;
            text-transform: uppercase;
        }

        .booking-title {
            margin: .75rem 0 1rem;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: clamp(2.6rem, 5vw, 4.4rem);
            font-weight: 500;
            line-height: 1;
        }

        .booking-form-panel {
            padding: clamp(1.4rem, 4vw, 2.5rem);
            background: #f8f6f1;
            box-shadow: 0 24px 70px rgb(0 0 0 / 25%);
        }

        .booking-form-title {
            margin: 0;
            color: #29241f;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 2rem;
            font-weight: 500;
        }

        .booking-field label {
            display: block;
            margin-bottom: .45rem;
            color: #3d3934;
            font-size: .9rem;
            font-weight: 600;
        }

        .booking-field .form-control,
        .booking-field .form-select {
            min-height: 48px;
            border-color: #d6d0c7;
            border-radius: 2px;
            background-color: #fff;
        }

        .booking-field textarea.form-control {
            min-height: 100px;
        }

        .booking-submit {
            min-height: 52px;
            border: 0;
            border-radius: 2px;
            background: #623e2a;
            color: #fff;
            font-weight: 700;
        }

        .booking-submit:hover {
            background: #482c1d;
            color: #fff;
        }

        @media (prefers-reduced-motion: reduce) {
            .booking-submit {
                transition: none;
            }
        }
    </style>
@endpush

@section('content')
    <section class="booking-page">
        <div class="container">
            <div class="row align-items-center justify-content-between g-4 g-lg-5">
                <div class="col-12 col-lg-4">
                    <div class="booking-intro">
                        <p class="booking-eyebrow mb-0">Yakiniku King</p>
                        <h1 class="booking-title">Đặt bàn<br>của bạn</h1>
                        <p class="mb-3">Hẹn một bữa ăn ngon cùng gia đình và bạn bè. Nhà hàng sẽ liên hệ xác nhận yêu cầu đặt bàn.</p>
                        <p class="mb-0">12 Phố Hàng Gai, Quận Hoàn Kiếm, Hà Nội</p>
                    </div>
                </div>

                <div class="col-12 col-lg-7">
                    <div class="booking-form-panel">
                        <div class="mb-4">
                            <p class="booking-eyebrow mb-1">Reservation</p>
                            <h2 class="booking-form-title">Thông tin đặt bàn</h2>
                        </div>

                        @if (session('booking_success'))
                            <div class="alert alert-success" role="status">Đã gửi thông tin đặt bàn.</div>
                        @endif

                        @if (session('booking_cancelled'))
                            <div class="alert alert-info" role="status">Đặt bàn đã được hủy.</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                Vui lòng kiểm tra lại thông tin đặt bàn.
                            </div>
                        @endif

                        <form method="POST" action="{{ route('booking.store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 booking-field">
                                    <label for="restaurant_id">Nhà hàng</label>
                                    <select id="restaurant_id" name="restaurant_id" class="form-select @error('restaurant_id') is-invalid @enderror" required>
                                        <option value="">Chọn nhà hàng</option>
                                        @foreach ($restaurants as $restaurant)
                                            <option value="{{ $restaurant->id }}" @selected(old('restaurant_id') == $restaurant->id)>
                                                {{ $restaurant->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('restaurant_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 booking-field">
                                    <label for="customer_name">Họ và tên</label>
                                    <input id="customer_name" name="customer_name" type="text" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" autocomplete="name" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 booking-field">
                                    <label for="phone">Số điện thoại</label>
                                    <input id="phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" autocomplete="tel" required>
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 booking-field">
                                    <label for="booking_date">Ngày đặt</label>
                                    <input id="booking_date" name="booking_date" type="date" min="{{ now()->toDateString() }}" class="form-control @error('booking_date') is-invalid @enderror" value="{{ old('booking_date') }}" required>
                                    @error('booking_date')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 booking-field">
                                    <label for="booking_time">Giờ đặt</label>
                                    <input id="booking_time" name="booking_time" type="time" class="form-control @error('booking_time') is-invalid @enderror" value="{{ old('booking_time') }}" required>
                                    @error('booking_time')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 booking-field">
                                    <label for="number_of_guests">Số khách</label>
                                    <input id="number_of_guests" name="number_of_guests" type="number" min="1" max="100" class="form-control @error('number_of_guests') is-invalid @enderror" value="{{ old('number_of_guests', 2) }}" required>
                                    @error('number_of_guests')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 booking-field">
                                    <label for="email">Email <span class="text-secondary fw-normal">(không bắt buộc)</span></label>
                                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email">
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 booking-field">
                                    <label for="note">Ghi chú</label>
                                    <textarea id="note" name="note" rows="3" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                                    @error('note')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 pt-1">
                                    <button class="btn booking-submit w-100" type="submit" @disabled($restaurants->isEmpty())>
                                        Gửi yêu cầu đặt bàn
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($booking)
        <div class="modal fade" id="bookingConfirmationModal" tabindex="-1" aria-labelledby="bookingConfirmationTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <div>
                            <p class="booking-eyebrow mb-1">Yakiniku King</p>
                            <h2 class="modal-title booking-form-title" id="bookingConfirmationTitle">Thông tin đặt bàn</h2>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>

                    <div class="modal-body pt-3">
                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
                            <div>
                                <div class="small text-secondary">Mã đặt bàn</div>
                                <strong class="fs-5">{{ $booking->booking_code }}</strong>
                            </div>
                            @if ($booking->status === 'confirmed')
                                <span class="badge rounded-pill text-bg-success px-3 py-2">Đã xác nhận</span>
                            @elseif ($booking->status === 'pending')
                                <span class="badge rounded-pill text-bg-warning px-3 py-2">Chưa xác nhận</span>
                            @elseif ($booking->status === 'cancelled')
                                <span class="badge rounded-pill text-bg-secondary px-3 py-2">Đã hủy</span>
                            @else
                                <span class="badge rounded-pill text-bg-primary px-3 py-2">Hoàn thành</span>
                            @endif
                        </div>

                        <div class="row g-4">
                            <div class="col-12 col-md-8">
                                <div id="bookingCustomerDetails" class="booking-confirmation-details">
                                    <dl class="row g-0 mb-0">
                                        <dt class="col-sm-5 py-2">Nhà hàng</dt>
                                        <dd class="col-sm-7 py-2">{{ $booking->restaurant->name }}</dd>
                                        <dt class="col-sm-5 py-2">Họ và tên</dt>
                                        <dd class="col-sm-7 py-2">{{ $booking->customer_name }}</dd>
                                        <dt class="col-sm-5 py-2">Số điện thoại</dt>
                                        <dd class="col-sm-7 py-2">{{ $booking->phone }}</dd>
                                        @if ($booking->email)
                                            <dt class="col-sm-5 py-2">Email</dt>
                                            <dd class="col-sm-7 py-2">{{ $booking->email }}</dd>
                                        @endif
                                        <dt class="col-sm-5 py-2">Ngày đặt</dt>
                                        <dd class="col-sm-7 py-2">{{ $booking->booking_date->format('d/m/Y') }}</dd>
                                        <dt class="col-sm-5 py-2">Giờ đặt</dt>
                                        <dd class="col-sm-7 py-2">{{ substr($booking->booking_time, 0, 5) }}</dd>
                                        <dt class="col-sm-5 py-2">Số khách</dt>
                                        <dd class="col-sm-7 py-2">{{ $booking->number_of_guests }}</dd>
                                        @if ($booking->note)
                                            <dt class="col-sm-5 py-2">Ghi chú</dt>
                                            <dd class="col-sm-7 py-2">{{ $booking->note }}</dd>
                                        @endif
                                    </dl>
                                </div>
                                <button class="btn btn-link btn-sm px-0 mt-2" id="toggleBookingDetails" type="button" aria-controls="bookingCustomerDetails" aria-expanded="true">
                                    Ẩn thông tin
                                </button>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="booking-qr-panel text-center">
                                    <div id="bookingQrCode" class="booking-qr-code mx-auto" data-qr-value="{{ $booking->qr_code }}" aria-label="Mã QR đặt bàn"></div>
                                    <p class="small text-secondary mb-0 mt-2">Quét mã khi đến nhà hàng</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <a class="btn btn-outline-dark" href="{{ route('home') }}">Trở về trang chủ</a>
                        @if (in_array($booking->status, ['pending', 'confirmed'], true))
                            <form method="POST" action="{{ route('booking.cancel') }}" onsubmit="return confirm('Bạn chắc chắn muốn hủy đặt bàn này?')">
                                @csrf
                                <button class="btn btn-outline-danger" type="submit">Hủy đặt bàn</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    @if ($booking)
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modalElement = document.getElementById('bookingConfirmationModal');
                const qrElement = document.getElementById('bookingQrCode');
                const detailsElement = document.getElementById('bookingCustomerDetails');
                const toggleDetailsButton = document.getElementById('toggleBookingDetails');

                if (window.QRCode && qrElement) {
                    new QRCode(qrElement, {
                        text: qrElement.dataset.qrValue,
                        width: 160,
                        height: 160,
                        colorDark: '#201e1a',
                        colorLight: '#ffffff',
                        correctLevel: QRCode.CorrectLevel.M,
                    });
                }

                toggleDetailsButton?.addEventListener('click', () => {
                    const isExpanded = toggleDetailsButton.getAttribute('aria-expanded') === 'true';
                    detailsElement.hidden = isExpanded;
                    toggleDetailsButton.setAttribute('aria-expanded', String(!isExpanded));
                    toggleDetailsButton.textContent = isExpanded ? 'Hiện thông tin' : 'Ẩn thông tin';
                });

                bootstrap.Modal.getOrCreateInstance(modalElement).show();
            });
        </script>
    @endif
@endpush
