@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Dashboard</h1>
            <p class="text-muted mb-0">
                Tổng quan hệ thống Yakiniku King
            </p>
        </div>
    </div>


    {{-- Statistics --}}
    <div class="row g-4 mb-4">

        {{-- Menu Items --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Món ăn
                            </p>

                            <h2 class="mb-0">
                                {{ $menuItemsCount }}
                            </h2>
                        </div>

                        <div class="fs-1">
                            🍖
                        </div>

                    </div>

                    <a href="{{ route('admin.menu.items.index') }}"
                       class="small text-decoration-none">
                        Quản lý món ăn →
                    </a>
                </div>
            </div>
        </div>


        {{-- Combo --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Combo
                            </p>

                            <h2 class="mb-0">
                                {{ $combosCount }}
                            </h2>
                        </div>

                        <div class="fs-1">
                            🍱
                        </div>

                    </div>

                    <a href="{{ route('admin.menu.combos.index') }}"
                       class="small text-decoration-none">
                        Quản lý combo →
                    </a>

                </div>
            </div>
        </div>


        {{-- Promotions --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Khuyến mãi
                            </p>

                            <h2 class="mb-0">
                                {{ $promotionsCount }}
                            </h2>
                        </div>

                        <div class="fs-1">
                            🎁
                        </div>

                    </div>

                    <a href="{{ route('admin.menu.promotions.index') }}"
                       class="small text-decoration-none">
                        Quản lý khuyến mãi →
                    </a>

                </div>
            </div>
        </div>


        {{-- Restaurants --}}
        <div class="col-md-6 col-xl-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <p class="text-muted mb-1">
                                Nhà hàng
                            </p>

                            <h2 class="mb-0">
                                {{ $restaurantsCount }}
                            </h2>
                        </div>

                        <div class="fs-1">
                            🏪
                        </div>

                    </div>

                    <a href="{{ route('admin.menu.restaurants.index') }}"
                       class="small text-decoration-none">
                        Quản lý nhà hàng →
                    </a>

                </div>
            </div>
        </div>

    </div>


    {{-- Second statistics row --}}
    <div class="row g-4 mb-4">

        {{-- Bookings --}}
        <div class="col-md-6">

            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <p class="text-muted mb-1">
                                Tổng số đặt bàn
                            </p>

                            <h2>
                                {{ $bookingsCount }}
                            </h2>
                        </div>

                        <div class="fs-1">
                            📅
                        </div>

                    </div>

                    <a href="{{ route('admin.menu.bookings.index') }}"
                       class="small text-decoration-none">
                        Xem danh sách đặt bàn →
                    </a>

                </div>
            </div>

        </div>


        {{-- Leads }}
        <div class="col-md-6">

            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <p class="text-muted mb-1">
                                Lead mới
                            </p>

                            <h2>
                                {{ $newLeadsCount }}
                            </h2>
                        </div>

                        <div class="fs-1">
                            📩
                        </div>

                    </div>

                    <a href="{{ route('admin.menu.leads.index') }}"
                       class="small text-decoration-none">
                        Xem lead →
                    </a>

                </div>
            </div>

        </div>

    </div>


    {{-- Recent bookings --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">

            <div class="d-flex justify-content-between align-items-center">

                <h5 class="mb-0">
                    Đặt bàn gần đây
                </h5>

                <a href="{{ route('admin.menu.bookings.index') }}"
                   class="btn btn-sm btn-outline-primary">
                    Xem tất cả
                </a>

            </div>

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover mb-0">

                    <thead>
                        <tr>
                            <th>Mã đặt bàn</th>
                            <th>Khách hàng</th>
                            <th>Nhà hàng</th>
                            <th>Ngày</th>
                            <th>Giờ</th>
                            <th>Số khách</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentBookings as $booking)

                            <tr>

                                <td>
                                    <strong>
                                        {{ $booking->booking_code }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $booking->customer_name }}
                                </td>

                                <td>
                                    {{ $booking->restaurant->name ?? '—' }}
                                </td>

                                <td>
                                    {{ $booking->booking_date?->format('d/m/Y') }}
                                </td>

                                <td>
                                    {{ $booking->booking_time }}
                                </td>

                                <td>
                                    {{ $booking->number_of_guests }}
                                </td>

                                <td>

                                    @if($booking->status === 'pending')

                                        <span class="badge bg-warning text-dark">
                                            Chờ xác nhận
                                        </span>

                                    @elseif($booking->status === 'confirmed')

                                        <span class="badge bg-success">
                                            Đã xác nhận
                                        </span>

                                    @elseif($booking->status === 'cancelled')

                                        <span class="badge bg-danger">
                                            Đã hủy
                                        </span>

                                    @elseif($booking->status === 'completed')

                                        <span class="badge bg-primary">
                                            Hoàn thành
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center py-4 text-muted">

                                    Chưa có đặt bàn nào.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- Quick actions --}}
    <div class="mt-4">

        <h5 class="mb-3">
            Truy cập nhanh
        </h5>

        <div class="d-flex flex-wrap gap-2">

            <a href="{{ route('admin.menu.items.create') }}"
               class="btn btn-primary">
                + Thêm món ăn
            </a>

            <a href="{{ route('admin.menu.combos.create') }}"
               class="btn btn-outline-primary">
                + Thêm combo
            </a>

            <a href="{{ route('admin.menu.promotions.create') }}"
               class="btn btn-outline-primary">
                + Thêm khuyến mãi
            </a>

            <a href="{{ route('admin.menu.bookings.index') }}"
               class="btn btn-outline-primary">
                Xem đặt bàn
            </a>

        </div>

    </div>

</div>

@endsection