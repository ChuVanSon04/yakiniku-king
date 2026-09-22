@extends('admin.layouts.app')

@section('title', 'Sửa công thức')

@section('page-title', 'Sửa công thức')

@section('content')

<h1>Sửa công thức</h1>


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
    action="{{ route('admin.menu.recipes.update', $recipe) }}"
    method="POST"
    enctype="multipart/form-data"
    style="
        background:white;
        padding:25px;
    "
>

    @csrf

    @method('PUT')


    @include('admin.menu.recipes._form')


    <button type="submit">
        Cập nhật công thức
    </button>


    <a href="{{ route('admin.menu.recipes.index') }}">
        Quay lại
    </a>

</form>

@endsection