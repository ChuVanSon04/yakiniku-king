<div style="margin-bottom:15px;">
    <label>Tiêu đề</label>
    <br>
    <input
        type="text"
        name="title"
        value="{{ old('title', $tip->title ?? '') }}"
        style="width:100%; padding:10px;"
        required
    >
</div>

@include('admin.menu.partials.english-field', ['name' => 'title_en', 'label' => 'Tiêu đề', 'value' => $tip->title_en ?? ''])

<div style="margin-bottom:15px;">
    <label>Slug</label>
    <br>
    <input
        type="text"
        name="slug"
        value="{{ old('slug', $tip->slug ?? '') }}"
        placeholder="Để trống để Laravel tự tạo"
        style="width:100%; padding:10px;"
    >
</div>

@include('admin.menu.partials.english-field', ['name' => 'short_description_en', 'label' => 'Mô tả ngắn', 'value' => $tip->short_description_en ?? '', 'type' => 'textarea', 'rows' => 4])

<div style="margin-bottom:15px;">
    <label>Mô tả ngắn</label>
    <br>
    <textarea name="short_description" rows="4" style="width:100%; padding:10px;">{{ old('short_description', $tip->short_description ?? '') }}</textarea>
</div>

<div style="margin-bottom:15px;">
    <label>Nội dung bí kíp</label>
    <br>
    <textarea name="content" rows="15" style="width:100%; padding:10px;">{{ old('content', $tip->content ?? '') }}</textarea>
</div>

@include('admin.menu.partials.english-field', ['name' => 'content_en', 'label' => 'Nội dung bí kíp', 'value' => $tip->content_en ?? '', 'type' => 'textarea', 'rows' => 15])

<div data-image-field style="margin-bottom:15px;">
    <label>Hình ảnh</label>
    <br>
    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">

    @if(isset($tip) && $tip->image)
        <input type="hidden" name="remove_image" value="0" data-image-remove-value>
        <div data-current-image-preview style="margin-top:10px;">
            <p>Ảnh hiện tại:</p>
            <img
                src="{{ asset('storage/' . $tip->image) }}"
                alt="{{ $tip->title }}"
                style="width:300px; max-height:200px; object-fit:cover;"
            >
        </div>
        <button class="admin-image-remove-button" type="button" data-image-remove-toggle aria-pressed="false">Xóa ảnh hiện tại</button>
    @endif
</div>

<div style="margin-bottom:15px;">
    <label>Ngày đăng</label>
    <br>
    <input
        type="datetime-local"
        name="published_at"
        value="{{ old('published_at', isset($tip) && $tip->published_at ? $tip->published_at->format('Y-m-d\\TH:i') : '') }}"
        style="width:100%; padding:10px;"
    >
</div>

<div style="margin-bottom:15px;">
    <label>
        <input
            type="checkbox"
            name="status"
            value="1"
            {{ old('status', $tip->status ?? true) ? 'checked' : '' }}
        >
        Hiển thị bí kíp
    </label>
</div>
