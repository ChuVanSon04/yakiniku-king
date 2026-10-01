@extends('fontend.layouts.app')

@section('title', 'Đặt bàn')

@push('styles')
    <style>
        .booking-page {
            min-height: calc(100svh - 80px);
            display: flex;
            align-items: center;
            padding-block: clamp(2.5rem, 6vw, 5rem);
            background: linear-gradient(105deg, rgb(17 24 20 / 88%), rgb(17 24 20 / 48%)), url('{{ asset('yakiniku-king/bg-about.jpg') }}') center / cover;
        }

        .booking-intro {
            max-width: 390px;
            color: #fff;
        }

        .booking-eyebrow {
            color: #ff0000;
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .booking-title {
            margin: .75rem 0 1rem;
            font-family: Georgia, 'Times New Roman', serif;
            font-size: 3.8rem;
            font-weight: 500;
            line-height: 1;
        }

        .booking-form-panel {
            padding: clamp(1.4rem, 4vw, 2.5rem);
            border-top: 4px solid #ff0000;
            background: #f6f4ee;
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

        .booking-required-mark {
            margin-left: .15rem;
            color: #c62828;
            font-weight: 700;
        }

        .booking-field .form-control,
        .booking-field .form-select {
            min-height: 48px;
            border-color: #d6d0c7;
            border-radius: 2px;
            background-color: #fff;
        }

        .booking-field .form-control:focus,
        .booking-field .form-select:focus {
            border-color: #a83d32;
            box-shadow: 0 0 0 .2rem rgb(168 61 50 / 14%);
        }

        .booking-time-note {
            margin-top: .45rem;
            color: #67635d;
            font-size: .8rem;
        }

        .booking-table-fieldset {
            min-width: 0;
            margin: 0;
            padding: 0;
            border: 0;
        }

        .booking-table-title {
            margin: 0 0 .35rem;
            color: #29241f;
            font-size: 1.05rem;
            font-weight: 700;
        }

        .booking-table-help {
            margin-bottom: .8rem;
            color: #67635d;
            font-size: .85rem;
            line-height: 1.55;
        }

        .booking-table-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: .65rem;
        }

        .booking-table-option {
            display: flex;
            min-width: 0;
            min-height: 52px;
            align-items: center;
            gap: .6rem;
            padding: .65rem .75rem;
            border: 1px solid #d6d0c7;
            border-radius: 2px;
            background: #fff;
            cursor: pointer;
        }

        .booking-table-option:has(input:checked) {
            border-color: #a83d32;
            background: #fff9f7;
        }

        .booking-table-option input {
            width: 1rem;
            height: 1rem;
            flex: 0 0 auto;
            accent-color: #a83d32;
        }

        .booking-table-code {
            color: #29241f;
            font-weight: 700;
        }

        .booking-table-capacity {
            margin-left: auto;
            color: #67635d;
            font-size: .8rem;
            white-space: nowrap;
        }

        .booking-preorder {
            padding-top: .5rem;
        }

        .booking-preorder-title {
            margin: 0 0 .35rem;
            color: #29241f;
            font-size: 1.15rem;
            font-weight: 700;
        }

        .booking-preorder-description {
            margin-bottom: .9rem;
            color: #67635d;
            font-size: .9rem;
        }

        .booking-preorder-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: .75rem;
        }

        .booking-preorder-option {
            display: flex;
            min-width: 0;
            min-height: 96px;
            align-items: center;
            gap: .8rem;
            padding: .7rem;
            border: 1px solid #d6d0c7;
            border-radius: 2px;
            background: #fff;
            cursor: pointer;
            transition: border-color .18s ease, background-color .18s ease;
        }

        .booking-preorder-option:has(.booking-preorder-checkbox:checked) {
            border-color: #a83d32;
            background: #fff9f7;
        }

        .booking-preorder-checkbox {
            width: 1.1rem;
            height: 1.1rem;
            flex: 0 0 auto;
            accent-color: #a83d32;
        }

        .booking-preorder-image {
            width: 64px;
            height: 64px;
            flex: 0 0 auto;
            object-fit: cover;
        }

        .booking-preorder-details {
            display: grid;
            min-width: 0;
            gap: .2rem;
        }

        .booking-preorder-name {
            overflow-wrap: anywhere;
            color: #29241f;
            font-size: .9rem;
            font-weight: 700;
        }

        .booking-preorder-copy {
            display: -webkit-box;
            overflow: hidden;
            color: #67635d;
            font-size: .78rem;
            line-height: 1.4;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .booking-preorder-price {
            color: #87332b;
            font-size: .82rem;
            font-weight: 700;
        }

        .booking-preorder-empty {
            margin: 0;
            color: #67635d;
            font-size: .9rem;
        }

        .booking-terms {
            margin: 0;
            padding: 1rem 1.1rem;
            border-left: 3px solid #d7b36a;
            background: #eeece5;
            color: #49453f;
            font-size: .86rem;
            line-height: 1.65;
        }

        .booking-submit {
            min-height: 52px;
            border: 0;
            border-radius: 2px;
            background: #a83d32;
            color: #fff;
            font-weight: 700;
        }

        .booking-submit:hover {
            background: #87332b;
            color: #fff;
        }

        .booking-actions {
            display: grid;
            grid-template-columns: minmax(100px, .4fr) minmax(0, 1fr);
            gap: .75rem;
        }

        .booking-cancel {
            min-height: 52px;
            border: 1px solid #8b8b84;
            border-radius: 2px;
            color: #3d3934;
            font-weight: 600;
        }

        .booking-cancel:hover,
        .booking-cancel:focus-visible {
            border-color: #5c5c56;
            background: #e8e6df;
            color: #29241f;
        }

        @media (max-width: 767.98px) {
            .booking-page {
                align-items: flex-start;
                padding-block: 1.5rem;
                background-position: center;
            }

            .booking-title {
                font-size: 2.7rem;
            }

            .booking-intro {
                max-width: none;
            }

            .booking-preorder-grid {
                grid-template-columns: minmax(0, 1fr);
            }

            .booking-table-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
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
                <div class="col-12 col-lg-4 order-2 order-lg-1">
                    <div class="booking-intro">
                        <p class="booking-eyebrow mb-0">Yakiniku King</p>
                        <h1 class="booking-title">Đặt bàn<br>của bạn</h1>
                        <p class="mb-3">Hẹn một bữa ăn ngon cùng gia đình và bạn bè. Nhà hàng sẽ liên hệ xác nhận yêu cầu đặt bàn.</p>
                        <p class="mb-0">12 Phố Hàng Gai, Quận Hoàn Kiếm, Hà Nội</p>
                    </div>
                </div>

                <div class="col-12 col-lg-7 order-1 order-lg-2">
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
                                    <label for="floor">Chọn tầng <span class="booking-required-mark" aria-hidden="true">*</span><span class="visually-hidden">(bắt buộc)</span></label>
                                    <select id="floor" name="floor" class="form-select @error('floor') is-invalid @enderror" required>
                                        <option value="">Chọn tầng</option>
                                        @foreach ([1, 2] as $floor)
                                            <option value="{{ $floor }}" @selected(old('floor') == $floor)>Tầng {{ $floor }}</option>
                                        @endforeach
                                    </select>
                                    @error('floor')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 booking-field">
                                    <label for="customer_name">Họ và tên <span class="booking-required-mark" aria-hidden="true">*</span><span class="visually-hidden">(bắt buộc)</span></label>
                                    <input id="customer_name" name="customer_name" type="text" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" autocomplete="name" required>
                                    @error('customer_name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 booking-field">
                                    <label for="phone">Số điện thoại <span class="booking-required-mark" aria-hidden="true">*</span><span class="visually-hidden">(bắt buộc)</span></label>
                                    <input id="phone" name="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" autocomplete="tel" required>
                                    @error('phone')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 booking-field">
                                    <label for="number_of_guests">Số lượng người <span class="booking-required-mark" aria-hidden="true">*</span><span class="visually-hidden">(bắt buộc)</span></label>
                                    <input id="number_of_guests" name="number_of_guests" type="number" min="1" max="100" class="form-control @error('number_of_guests') is-invalid @enderror" value="{{ old('number_of_guests', 2) }}" required>
                                    @error('number_of_guests')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 col-md-6 booking-field booking-note">
                                    <label for="note">Ghi chú</label>
                                    <input id="note" name="note" type="text" maxlength="2000" class="form-control @error('note') is-invalid @enderror" value="{{ old('note') }}">
                                    @error('note')
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
                                    <div class="booking-time-note">Thời gian giữ bàn tối đa 10 phút</div>
                                    @error('booking_time')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <fieldset class="col-12 booking-table-fieldset" aria-describedby="bookingTableHelp">
                                    <legend class="booking-table-title">Chọn bàn</legend>
                                    <p class="booking-table-help" id="bookingTableHelp">
                                        Chọn một hoặc nhiều bàn ở tầng đã chọn để đủ chỗ cho số khách. Mỗi tầng có tổng sức chứa {{ $maximumFloorCapacity }} người; với đoàn đông hơn, nhà hàng sẽ bố trí bàn khi xác nhận.
                                    </p>
                                    <div class="booking-table-grid">
                                        @foreach ($tableCapacities as $tableCode => $capacity)
                                            <label class="booking-table-option" for="table_{{ $tableCode }}">
                                                <input
                                                    id="table_{{ $tableCode }}"
                                                    name="table_codes[]"
                                                    type="checkbox"
                                                    value="{{ $tableCode }}"
                                                    @checked(in_array($tableCode, (array) old('table_codes', [])))>
                                                <span class="booking-table-code">{{ $tableCode }}</span>
                                                <span class="booking-table-capacity">{{ $capacity }} người</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    @error('table_codes')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </fieldset>

                                <section class="col-12 booking-preorder" aria-labelledby="preOrderTitle">
                                    <h3 class="booking-preorder-title" id="preOrderTitle">Gọi món trước</h3>
                                    <p class="booking-preorder-description">Chọn trước món Must Try để nhà hàng chuẩn bị cho bàn của bạn.</p>

                                    @if ($mustTryMenuItems->isNotEmpty())
                                        <div class="booking-preorder-grid">
                                            @foreach ($mustTryMenuItems as $menuItem)
                                                <label class="booking-preorder-option" for="pre_order_item_{{ $menuItem->id }}">
                                                    <input
                                                        class="booking-preorder-checkbox"
                                                        id="pre_order_item_{{ $menuItem->id }}"
                                                        name="pre_order_items[]"
                                                        type="checkbox"
                                                        value="{{ $menuItem->id }}"
                                                        @checked(in_array($menuItem->id, (array) old('pre_order_items', [])))>
                                                    @if ($menuItem->image)
                                                        <img
                                                            class="booking-preorder-image"
                                                            src="{{ asset(str_starts_with($menuItem->image, 'menu/') ? 'storage/' . $menuItem->image : $menuItem->image) }}"
                                                            alt="{{ $menuItem->name }}"
                                                            loading="lazy">
                                                    @endif
                                                    <span class="booking-preorder-details">
                                                        <span class="booking-preorder-name">{{ $menuItem->name }}</span>
                                                        @if ($menuItem->description)
                                                            <span class="booking-preorder-copy">{{ $menuItem->description }}</span>
                                                        @endif
                                                        <span class="booking-preorder-price">{{ number_format((float) $menuItem->price, 0, ',', '.') }} đ</span>
                                                    </span>
                                                </label>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="booking-preorder-empty">Hiện chưa có món Must Try để chọn trước.</p>
                                    @endif

                                    @error('pre_order_items')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </section>

                                <div class="col-12">
                                    <p class="booking-terms">
                                        <strong>Điều khoản và lưu ý đặt bàn</strong><br>
                                        Nhà hàng giữ bàn tối đa 15 phút, sau thời gian này xin phép phục vụ khách tiếp theo. Với đoàn đông từ 15 khách trở lên hoặc có yêu cầu đặc biệt, vui lòng chờ xác nhận đặt bàn thành công từ nhà hàng.
                                    </p>
                                </div>

                                <div class="col-12 pt-1">
                                    <div class="booking-actions">
                                        <a class="btn booking-cancel d-inline-flex align-items-center justify-content-center" href="{{ route('home') }}">
                                            Hủy bỏ
                                        </a>
                                        <button class="btn booking-submit w-100" type="submit" @disabled($restaurants->isEmpty())>
                                            Gửi yêu cầu đặt bàn
                                        </button>
                                    </div>
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
                                        <dt class="col-sm-5 py-2">Tầng</dt>
                                        <dd class="col-sm-7 py-2">{{ $booking->floor ? 'Tầng '.$booking->floor : 'Nhà hàng bố trí khi xác nhận' }}</dd>
                                        <dt class="col-sm-5 py-2">Bàn</dt>
                                        <dd class="col-sm-7 py-2">{{ $booking->table_codes ? implode(', ', $booking->table_codes) : 'Nhà hàng bố trí khi xác nhận' }}</dd>
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
                                        @if ($booking->pre_order_items)
                                            <dt class="col-sm-5 py-2">Gọi món trước</dt>
                                            <dd class="col-sm-7 py-2">
                                                <ul class="mb-0 ps-3">
                                                    @foreach ($booking->pre_order_items as $preOrderItem)
                                                        <li>{{ $preOrderItem['name'] }}</li>
                                                    @endforeach
                                                </ul>
                                            </dd>
                                        @endif
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
