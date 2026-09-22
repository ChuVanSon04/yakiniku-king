@extends('admin.layouts.app')

@section('title', 'Thêm bí kíp')

@section('page-title', 'Thêm bí kíp')

@section('content')

    <h1>Thêm bí kíp</h1>

    @if($errors->any())
        <div style="color:red; margin-bottom:20px;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.menu.tips.store') }}"
        method="POST"
        enctype="multipart/form-data"
        style="background:white; padding:25px;"
    >
        @csrf

        @include('admin.menu.tips._form')

        <button type="submit">Lưu bí kíp</button>
        <a href="{{ route('admin.menu.tips.index') }}">Quay lại</a>
    </form>

@endsection
