@extends('admin.layouts.app')

@section('title', 'Sửa bí kíp')

@section('page-title', 'Sửa bí kíp')

@section('content')

    <h1>Sửa bí kíp</h1>

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
        action="{{ route('admin.menu.tips.update', $tip) }}"
        method="POST"
        enctype="multipart/form-data"
        style="background:white; padding:25px;"
    >
        @csrf
        @method('PUT')

        @include('admin.menu.tips._form')

        <button type="submit">Cập nhật bí kíp</button>
        <a href="{{ route('admin.menu.tips.index') }}">Quay lại</a>
    </form>

@endsection
