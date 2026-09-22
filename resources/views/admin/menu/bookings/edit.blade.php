@extends('admin.layouts.app')

@section('content')

<h1>Chỉnh sửa booking</h1>

@if ($errors->any())

    <div>
        <strong>Có lỗi xảy ra:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif


<form
    action="{{ route('admin.menu.bookings.update', $booking) }}"
    method="POST"
>
    @csrf
    @method('PUT')

    @include('admin.menu.bookings._form', [
        'buttonText' => 'Cập nhật booking'
    ])

</form>

@endsection