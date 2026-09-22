@extends('admin.layouts.app')

@section('content')

<h1>Chỉnh sửa nhà hàng</h1>

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
    action="{{ route('admin.menu.restaurants.update', $restaurant) }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    @method('PUT')

    @include('admin.menu.restaurants._form', [
        'buttonText' => 'Cập nhật nhà hàng'
    ])

</form>

@endsection