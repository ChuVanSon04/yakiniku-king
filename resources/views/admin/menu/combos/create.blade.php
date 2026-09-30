@extends('admin.layouts.app')

@section('title', 'Thêm Combo')

@section('page-title', 'Thêm Combo')

@section('content')

    <h1>Thêm Combo</h1>


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
        action="{{ route('admin.menu.combos.store') }}"
        method="POST"
        enctype="multipart/form-data"
        style="
            background:white;
            padding:25px;
        "
    >

        @csrf

        @include('admin.menu.combos._form')

        <button
            type="submit"
            style="
                background:#111;
                color:white;
                padding:10px 20px;
                border:none;
                border-radius:5px;
            "
        >
            Lưu Combo
        </button>


        <a
            href="{{ route('admin.menu.combos.index') }}"
            style="margin-left:10px;"
        >
            Quay lại
        </a>

    </form>

@endsection