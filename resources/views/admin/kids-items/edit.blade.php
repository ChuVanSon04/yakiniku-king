@extends('admin.layouts.app')

@section('title', 'Sửa nội dung trẻ em')

@section('page-title', 'Sửa nội dung trẻ em')

@section('content')
    <h1>Sửa nội dung dành cho trẻ em</h1>

    @if ($errors->any())
        <div style="color:red; margin-bottom:16px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kids-items.update', $kidsItem) }}" method="POST" enctype="multipart/form-data" style="background:white; padding:25px;">
        @csrf
        @method('PUT')

        <div style="margin-bottom:20px;">
            <label for="name">Tên</label>
            <input id="name" type="text" name="name" value="{{ old('name', $kidsItem->name) }}" required style="display:block; width:100%; padding:10px;">
        </div>

        <div style="margin-bottom:20px;">
            <label for="slug">Slug</label>
            <input id="slug" type="text" name="slug" value="{{ old('slug', $kidsItem->slug) }}" style="display:block; width:100%; padding:10px;">
        </div>

        <div style="margin-bottom:20px;">
            <label for="type">Loại nội dung</label>
            <select id="type" name="type" required style="display:block; width:100%; padding:10px;">
                @foreach ($typeLabels as $value => $label)
                    <option value="{{ $value }}" @selected(old('type', $kidsItem->type) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:20px;">
            <label for="food_category">Nhóm món ăn</label>
            <select id="food_category" name="food_category" style="display:block; width:100%; padding:10px;">
                <option value="">Không áp dụng</option>
                @foreach ($foodCategoryLabels as $value => $label)
                    <option value="{{ $value }}" @selected(old('food_category', $kidsItem->food_category) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom:20px;">
            <label for="description">Mô tả</label>
            <textarea id="description" name="description" rows="5" style="display:block; width:100%; padding:10px;">{{ old('description', $kidsItem->description) }}</textarea>
        </div>

        <div data-image-field style="margin-bottom:20px;">
            <label for="image">Hình ảnh</label>
            <input id="image" type="file" name="image" accept=".jpg,.jpeg,.png,.webp" style="display:block; width:100%; padding:10px;">
            @if ($kidsItem->image)
                <input type="hidden" name="remove_image" value="0" data-image-remove-value>
                <div data-current-image-preview>
                    <img src="{{ asset('storage/' . $kidsItem->image) }}" alt="{{ $kidsItem->name }}" style="display:block; max-width:240px; margin-top:12px;">
                </div>
                <button class="admin-image-remove-button" type="button" data-image-remove-toggle aria-pressed="false">Xóa ảnh hiện tại</button>
            @endif
        </div>

        <div style="margin-bottom:20px;">
            <label for="price">Giá (không bắt buộc)</label>
            <input id="price" type="number" name="price" value="{{ old('price', $kidsItem->price) }}" min="0" step="0.01" style="display:block; width:100%; padding:10px;">
        </div>

        <div style="margin-bottom:20px;">
            <label for="sort_order">Thứ tự</label>
            <input id="sort_order" type="number" name="sort_order" value="{{ old('sort_order', $kidsItem->sort_order) }}" min="0" style="display:block; width:100%; padding:10px;">
        </div>

        <label style="margin-bottom:20px;">
            <input type="checkbox" name="status" value="1" @checked(old('status', $kidsItem->status) == true)>
            Hiển thị
        </label>

        <div>
            <button type="submit">Cập nhật</button>
            <a href="{{ route('admin.kids-items.index') }}" style="margin-left:10px;">Quay lại</a>
        </div>
    </form>
@endsection