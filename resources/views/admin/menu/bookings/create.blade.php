@extends('admin.layouts.app')

@section('content')

<h1>Thêm booking</h1>

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
    action="{{ route('admin.menu.bookings.store') }}"
    method="POST"
>
    @csrf

    @include('admin.menu.bookings._form', [
        'buttonText' => 'Thêm booking'
    ])

</form>

@endsection