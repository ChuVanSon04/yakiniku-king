@extends('admin.layouts.app')

@section('title', 'Thêm khuyến mãi')

@section('page-title', 'Thêm khuyến mãi')

@section('content')

<h1>Thêm khuyến mãi</h1>


@if($errors->any())

    <div style="color:red; margin-bottom:20px;">

        <ul>

            @foreach($errors->all() as $error)

                <li>
                    {{ $error }}
                </li>

            @endforeach

        </ul>

    </div>

@endif


<form
    action="{{ route('admin.menu.promotions.store') }}"
    method="POST"
    enctype="multipart/form-data"
    style="
        background:white;
        padding:25px;
    "
>

    @csrf

    @include('admin.menu.promotions._form')


    <button type="submit">
        Lưu khuyến mãi
    </button>


    <a href="{{ route('admin.menu.promotions.index') }}">
        Quay lại
    </a>

</form>

@endsection