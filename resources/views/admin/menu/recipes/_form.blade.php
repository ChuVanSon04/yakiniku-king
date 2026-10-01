<div style="margin-bottom:15px;">

    <label>
        Tiêu đề
    </label>

    <br>

    <input
        type="text"
        name="title"
        value="{{ old('title', $recipe->title ?? '') }}"
        style="
            width:100%;
            padding:10px;
        "
    >

</div>

@include('admin.menu.partials.english-field', [
    'name' => 'title_en',
    'label' => 'Tiêu đề',
    'value' => $recipe->title_en ?? '',
])


<div style="margin-bottom:15px;">

    <label>
        Slug
    </label>

    <br>

    <input
        type="text"
        name="slug"
        value="{{ old('slug', $recipe->slug ?? '') }}"
        placeholder="Để trống để Laravel tự tạo"
        style="
            width:100%;
            padding:10px;
        "
    >

</div>

@include('admin.menu.partials.english-field', [
    'name' => 'short_description_en',
    'label' => 'Mô tả ngắn',
    'value' => $recipe->short_description_en ?? '',
    'type' => 'textarea',
    'rows' => 4,
])


<div style="margin-bottom:15px;">

    <label>
        Mô tả ngắn
    </label>

    <br>

    <textarea
        name="short_description"
        rows="4"
        style="
            width:100%;
            padding:10px;
        "
    >{{ old(
        'short_description',
        $recipe->short_description ?? ''
    ) }}</textarea>

</div>


<div style="margin-bottom:15px;">

    <label>
        Nội dung công thức
    </label>

    <br>

    <textarea
        name="content"
        rows="15"
        style="
            width:100%;
            padding:10px;
        "
    >{{ old(
        'content',
        $recipe->content ?? ''
    ) }}</textarea>

</div>

@include('admin.menu.partials.english-field', [
    'name' => 'content_en',
    'label' => 'Nội dung công thức',
    'value' => $recipe->content_en ?? '',
    'type' => 'textarea',
    'rows' => 15,
])


<div data-image-field style="margin-bottom:15px;">

    <label>
        Hình ảnh
    </label>

    <br>

    <input
        type="file"
        name="image"
        accept=".jpg,.jpeg,.png,.webp"
    >


    @if(isset($recipe) && $recipe->image)

        <input type="hidden" name="remove_image" value="0" data-image-remove-value>
        <div data-current-image-preview style="margin-top:10px;">

            <p>Ảnh hiện tại:</p>

            <img
                src="{{ asset('storage/' . $recipe->image) }}"
                alt="{{ $recipe->title }}"
                style="
                    width:300px;
                    max-height:200px;
                    object-fit:cover;
                "
            >

        </div>

        <button class="admin-image-remove-button" type="button" data-image-remove-toggle aria-pressed="false">Xóa ảnh hiện tại</button>

    @endif

</div>


<div style="margin-bottom:15px;">

    <label>
        Ngày đăng
    </label>

    <br>

    <input
        type="datetime-local"
        name="published_at"
        value="{{ old(
            'published_at',
            isset($recipe) && $recipe->published_at
                ? $recipe->published_at->format('Y-m-d\TH:i')
                : ''
        ) }}"
        style="
            width:100%;
            padding:10px;
        "
    >

</div>


<div style="margin-bottom:15px;">

    <label>

        <input
            type="checkbox"
            name="status"
            value="1"
            {{ old(
                'status',
                $recipe->status ?? true
            ) ? 'checked' : '' }}
        >

        Hiển thị công thức

    </label>

</div>