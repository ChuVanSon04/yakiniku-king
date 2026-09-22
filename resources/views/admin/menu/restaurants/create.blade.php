@extends('admin.layouts.app')

@section('content')

<h1>Thêm nhà hàng</h1>

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
    action="{{ route('admin.menu.restaurants.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @include('admin.menu.restaurants._form', [
        'buttonText' => 'Thêm nhà hàng'
    ])

</form>

@endsection