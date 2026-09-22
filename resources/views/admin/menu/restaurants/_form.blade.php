<div style="margin-bottom: 15px;">
    <label>Tên nhà hàng</label>

    <input
        type="text"
        name="name"
        value="{{ old('name', $restaurant->name ?? '') }}"
        style="width: 100%; padding: 8px;"
        required
    >
</div>


<div style="margin-bottom: 15px;">
    <label>Địa chỉ</label>

    <textarea
        name="address"
        rows="3"
        style="width: 100%; padding: 8px;"
        required
    >{{ old('address', $restaurant->address ?? '') }}</textarea>
</div>


<div style="margin-bottom: 15px;">
    <label>Số điện thoại</label>

    <input
        type="text"
        name="phone"
        value="{{ old('phone', $restaurant->phone ?? '') }}"
        style="width: 100%; padding: 8px;"
    >
</div>


<div style="display: flex; gap: 15px; margin-bottom: 15px;">

    <div style="flex: 1;">
        <label>Latitude</label>

        <input
            type="number"
            step="any"
            name="latitude"
            value="{{ old('latitude', $restaurant->latitude ?? '') }}"
            style="width: 100%; padding: 8px;"
        >
    </div>

    <div style="flex: 1;">
        <label>Longitude</label>

        <input
            type="number"
            step="any"
            name="longitude"
            value="{{ old('longitude', $restaurant->longitude ?? '') }}"
            style="width: 100%; padding: 8px;"
        >
    </div>

</div>


<div style="margin-bottom: 15px;">
    <label>Google Maps URL</label>

    <input
        type="url"
        name="google_map_url"
        value="{{ old('google_map_url', $restaurant->google_map_url ?? '') }}"
        style="width: 100%; padding: 8px;"
        placeholder="https://maps.google.com/..."
    >
</div>


<div style="display: flex; gap: 15px; margin-bottom: 15px;">

    <div style="flex: 1;">
        <label>Giờ mở cửa</label>

        <input
            type="time"
            name="opening_time"
            value="{{ old('opening_time', isset($restaurant) && $restaurant->opening_time ? substr($restaurant->opening_time, 0, 5) : '') }}"
            style="width: 100%; padding: 8px;"
        >
    </div>

    <div style="flex: 1;">
        <label>Giờ đóng cửa</label>

        <input
            type="time"
            name="closing_time"
            value="{{ old('closing_time', isset($restaurant) && $restaurant->closing_time ? substr($restaurant->closing_time, 0, 5) : '') }}"
            style="width: 100%; padding: 8px;"
        >
    </div>

</div>


<div style="margin-bottom: 15px;">
    <label>Ảnh nhà hàng</label>

    <input
        type="file"
        name="image"
        accept="image/*"
    >

    @if(isset($restaurant) && $restaurant->image)

        <div style="margin-top: 10px;">
            <img
                src="{{ asset('storage/' . $restaurant->image) }}"
                alt="{{ $restaurant->name }}"
                width="150"
            >
        </div>

    @endif
</div>


<div style="margin-bottom: 15px;">
    <label>
        <input
            type="checkbox"
            name="status"
            value="1"
            {{ old('status', $restaurant->status ?? true) ? 'checked' : '' }}
        >

        Đang hoạt động
    </label>
</div>


<button type="submit">
    {{ $buttonText ?? 'Lưu' }}
</button>