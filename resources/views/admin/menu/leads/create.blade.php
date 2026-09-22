@extends('admin.layouts.app')

@section('content')

<h1>Thêm Lead</h1>

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
    action="{{ route('admin.menu.leads.store') }}"
    method="POST"
>
    @csrf

    @include('admin.menu.leads._form', [
        'buttonText' => 'Thêm Lead'
    ])

</form>

@endsection