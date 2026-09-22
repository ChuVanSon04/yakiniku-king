@extends('admin.layouts.app')

@section('content')

<h1>Quản lý đặt bàn</h1>


@if(session('success'))

    <div style="margin-bottom: 15px;">
        {{ session('success') }}
    </div>

@endif


<div style="margin-bottom: 20px;">

    <a href="{{ route('admin.menu.bookings.create') }}">
        + Thêm booking
    </a>

</div>


<table
    border="1"
    cellpadding="10"
    cellspacing="0"
    width="100%"
>

    <thead>

        <tr>
            <th>Mã booking</th>
            <th>Nhà hàng</th>
            <th>Khách hàng</th>
            <th>SĐT</th>
            <th>Ngày</th>
            <th>Giờ</th>
            <th>Số người</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>

    </thead>


    <tbody>

        @forelse($bookings as $booking)

            <tr>

                <td>
                    {{ $booking->booking_code }}
                </td>


                <td>
                    {{ $booking->restaurant->name ?? '-' }}
                </td>


                <td>
                    {{ $booking->customer_name }}
                </td>


                <td>
                    {{ $booking->phone }}
                </td>


                <td>
                    {{ $booking->booking_date->format('d/m/Y') }}
                </td>


                <td>
                    {{ substr($booking->booking_time, 0, 5) }}
                </td>


                <td>
                    {{ $booking->number_of_guests }}
                </td>


                <td>

                    @switch($booking->status)

                        @case('pending')
                            Chờ xác nhận
                            @break

                        @case('confirmed')
                            Đã xác nhận
                            @break

                        @case('cancelled')
                            Đã hủy
                            @break

                        @case('completed')
                            Đã hoàn thành
                            @break

                    @endswitch

                </td>


                <td>

                    <a href="{{ route('admin.menu.bookings.edit', $booking) }}">
                        Sửa
                    </a>


                    <form
                        action="{{ route('admin.menu.bookings.destroy', $booking) }}"
                        method="POST"
                        style="display:inline;"
                        onsubmit="return confirm('Bạn có chắc muốn xóa booking này?')"
                    >

                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            Xóa
                        </button>

                    </form>

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="9">
                    Chưa có booking nào.
                </td>

            </tr>

        @endforelse

    </tbody>

</table>

@endsection