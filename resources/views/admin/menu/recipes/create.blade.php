@extends('admin.layouts.app')

@section('title', 'Thêm công thức')

@section('page-title', 'Thêm công thức')

@section('content')

<h1>Thêm công thức</h1>


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
    action="{{ route('admin.menu.recipes.store') }}"
    method="POST"
    enctype="multipart/form-data"
    style="
        background:white;
        padding:25px;
    "
>

    @csrf

    @include('admin.menu.recipes._form')


    <button type="submit">
        Lưu công thức
    </button>


    <a href="{{ route('admin.menu.recipes.index') }}">
        Quay lại
    </a>

</form>

@endsection