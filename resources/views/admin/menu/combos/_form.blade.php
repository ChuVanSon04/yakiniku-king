<div style="margin-bottom:20px;">

    <label>
        Tên Combo
    </label>

    <br>

    <input
        type="text"
        name="name"
        value="{{ old('name', $combo->name ?? '') }}"
        required
        style="width:100%; padding:10px;"
    >

</div>


<div style="margin-bottom:20px;">

    <label>
        Slug
    </label>

    <br>

    <input
        type="text"
        name="slug"
        value="{{ old('slug', $combo->slug ?? '') }}"
        style="width:100%; padding:10px;"
    >

</div>


<div style="margin-bottom:20px;">

    <label>
        Mô tả
    </label>

    <br>

    <textarea
        name="description"
        rows="5"
        style="width:100%; padding:10px;"
    >{{ old('description', $combo->description ?? '') }}</textarea>

</div>


<div style="margin-bottom:20px;">

    <label>
        Hình ảnh
    </label>

    <br>

    <input
        type="file"
        name="image"
        accept=".jpg,.jpeg,.png,.webp"
        style="width:100%; padding:10px;"
    >

    @if(isset($combo) && $combo->image)
        <p>Ảnh hiện tại:</p>
        <img src="{{ asset('storage/' . $combo->image) }}" alt="{{ $combo->name }}" style="max-width:240px;">
        <p>Để trống nếu muốn giữ ảnh hiện tại.</p>
    @endif

</div>


<div style="margin-bottom:20px;">

    <label>
        Giá bán
    </label>

    <br>

    <input
        type="number"
        name="price"
        value="{{ old('price', $combo->price ?? '') }}"
        min="0"
        step="0.01"
        required
        style="width:100%; padding:10px;"
    >

</div>


<div style="margin-bottom:20px;">

    <label>
        Giá gốc
    </label>

    <br>

    <input
        type="number"
        name="original_price"
        value="{{ old('original_price', $combo->original_price ?? '') }}"
        min="0"
        step="0.01"
        style="width:100%; padding:10px;"
    >

</div>


<div style="margin-bottom:20px;">

    <label>
        Ngày bắt đầu
    </label>

    <br>

    <input
        type="date"
        name="start_date"
        value="{{ old('start_date', isset($combo) && $combo->start_date ? $combo->start_date->format('Y-m-d') : '') }}"
        style="width:100%; padding:10px;"
    >

</div>


<div style="margin-bottom:20px;">

    <label>
        Ngày kết thúc
    </label>

    <br>

    <input
        type="date"
        name="end_date"
        value="{{ old('end_date', isset($combo) && $combo->end_date ? $combo->end_date->format('Y-m-d') : '') }}"
        style="width:100%; padding:10px;"
    >

</div>


<div style="margin-bottom:20px;">

    <label>
        Thứ tự
    </label>

    <br>

    <input
        type="number"
        name="sort_order"
        value="{{ old('sort_order', $combo->sort_order ?? 0) }}"
        min="0"
        style="width:100%; padding:10px;"
    >

</div>


<h2>
    Các món trong Combo
</h2>


<div id="combo-items">

    @php

        $selectedItems = old(
            'items',
            isset($combo)
                ? $combo->menuItems->map(function ($item) {
                    return [
                        'menu_item_id' => $item->id,
                        'quantity' => $item->pivot->quantity,
                    ];
                })->toArray()
                : [
                    [
                        'menu_item_id' => '',
                        'quantity' => 1,
                    ]
                ]
        );

    @endphp


    @foreach($selectedItems as $index => $selected)

        <div
            class="combo-item"
            style="
                display:flex;
                gap:10px;
                margin-bottom:10px;
            "
        >

            <select
                name="items[{{ $index }}][menu_item_id]"
                style="
                    flex:1;
                    padding:10px;
                "
            >

                <option value="">
                    -- Chọn món --
                </option>

                @foreach($menuItems as $menuItem)

                    <option
                        value="{{ $menuItem->id }}"
                        {{ $selected['menu_item_id'] == $menuItem->id ? 'selected' : '' }}
                    >
                        {{ $menuItem->name }}
                        -
                        {{ number_format($menuItem->price, 0, ',', '.') }} ₫
                    </option>

                @endforeach

            </select>


            <input
                type="number"
                name="items[{{ $index }}][quantity]"
                value="{{ $selected['quantity'] }}"
                min="1"
                style="
                    width:100px;
                    padding:10px;
                "
            >


            <button
                type="button"
                onclick="removeComboItem(this)"
            >
                Xóa
            </button>

        </div>

    @endforeach

</div>


<button
    type="button"
    onclick="addComboItem()"
    style="
        margin-bottom:20px;
        padding:10px 15px;
    "
>
    + Thêm món
</button>


<div style="margin-bottom:20px;">

    @php
        $isActive = old('status', isset($combo) ? $combo->status : true);
    @endphp

    <label>

        <input
            type="checkbox"
            name="status"
            value="1"
            {{ $isActive ? 'checked' : '' }}
        >

        Hiển thị

    </label>

</div>


<script>

    let itemIndex =
        document.querySelectorAll('#combo-items .combo-item').length;


    function addComboItem()
    {
        const container =
            document.getElementById('combo-items');

        const div =
            document.createElement('div');

        div.className =
            'combo-item';

        div.style =
            'display:flex; gap:10px; margin-bottom:10px;';

        div.innerHTML = `

            <select
                name="items[${itemIndex}][menu_item_id]"
                style="flex:1; padding:10px;"
            >

                <option value="">
                    -- Chọn món --
                </option>

                @foreach($menuItems as $menuItem)

                    <option value="{{ $menuItem->id }}">
                        {{ $menuItem->name }}
                        -
                        {{ number_format($menuItem->price, 0, ',', '.') }} ₫
                    </option>

                @endforeach

            </select>

            <input
                type="number"
                name="items[${itemIndex}][quantity]"
                value="1"
                min="1"
                style="width:100px; padding:10px;"
            >

            <button
                type="button"
                onclick="removeComboItem(this)"
            >
                Xóa
            </button>

        `;

        container.appendChild(div);

        itemIndex++;
    }


    function removeComboItem(button)
    {
        button
            .parentElement
            .remove();
    }

</script>