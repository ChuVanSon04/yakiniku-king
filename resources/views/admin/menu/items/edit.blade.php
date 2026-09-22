@extends('admin.layouts.app')

@section('title', 'Sửa món')

@section('page-title', 'Sửa món')

@section('content')

    <h1>Sửa món ăn</h1>

    @if($errors->any())

        <div style="color:red;">

            <ul>

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.menu.items.update', $item) }}"
        method="POST"
        style="background:white; padding:25px;"
    >

        @csrf

        @method('PUT')


        <div style="margin-bottom:20px;">

            <label>Danh mục</label>

            <br>

            <select
                name="category_id"
                style="width:100%; padding:10px;"
                required
            >

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>

        </div>


        <div style="margin-bottom:20px;">

            <label>Tên món</label>

            <br>

            <input
                type="text"
                name="name"
                value="{{ old('name', $item->name) }}"
                style="width:100%; padding:10px;"
                required
            >

        </div>


        <div style="margin-bottom:20px;">

            <label>Slug</label>

            <br>

            <input
                type="text"
                name="slug"
                value="{{ old('slug', $item->slug) }}"
                style="width:100%; padding:10px;"
            >

        </div>


        <div style="margin-bottom:20px;">

            <label>Mô tả</label>

            <br>

            <textarea
                name="description"
                rows="5"
                style="width:100%; padding:10px;"
            >{{ old('description', $item->description) }}</textarea>

        </div>


        <div style="margin-bottom:20px;">

            <label>Hình ảnh</label>

            <br>

            <input
                type="text"
                name="image"
                value="{{ old('image', $item->image) }}"
                style="width:100%; padding:10px;"
            >

        </div>


        <div style="margin-bottom:20px;">

            <label>Giá</label>

            <br>

            <input
                type="number"
                name="price"
                value="{{ old('price', $item->price) }}"
                min="0"
                step="0.01"
                style="width:100%; padding:10px;"
                required
            >

        </div>


        <div style="margin-bottom:20px;">

            <label>Thứ tự</label>

            <br>

            <input
                type="number"
                name="sort_order"
                value="{{ old('sort_order', $item->sort_order) }}"
                min="0"
                style="width:100%; padding:10px;"
            >

        </div>


        <div style="margin-bottom:15px;">

            <label>

                <input
                    type="checkbox"
                    name="is_must_try"
                    value="1"
                    {{ $item->is_must_try ? 'checked' : '' }}
                >

                Must Try

            </label>

        </div>


        <div style="margin-bottom:15px;">

            <label>

                <input
                    type="checkbox"
                    name="is_for_kids"
                    value="1"
                    {{ $item->is_for_kids ? 'checked' : '' }}
                >

                For Kids

            </label>

        </div>


        <div style="margin-bottom:20px;">

            <label>

                <input
                    type="checkbox"
                    name="status"
                    value="1"
                    {{ $item->status ? 'checked' : '' }}
                >

                Hiển thị

            </label>

        </div>


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
            Cập nhật
        </button>

        <a
            href="{{ route('admin.menu.items.index') }}"
            style="margin-left:10px;"
        >
            Quay lại
        </a>

    </form>

@endsection