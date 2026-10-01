@extends('admin.layouts.app')

@section('content')

<h1>Cài đặt website</h1>

@if(session('success'))

    <div style="margin-bottom: 15px;">
        {{ session('success') }}
    </div>

@endif


@if ($errors->any())

    <div style="margin-bottom: 15px;">

        <strong>Có lỗi xảy ra:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif


<form
    action="{{ route('admin.menu.settings.update') }}"
    method="POST"
>

    @csrf
    @method('PUT')


    <div style="margin-bottom: 20px;">

        <label>
            Tên website
        </label>

        <input
            type="text"
            name="settings[site_name]"
            value="{{ old('settings.site_name', $settings['site_name'] ?? '') }}"
            style="width: 100%; padding: 8px;"
        >

    </div>

    <div style="margin-bottom: 20px;">
        <label for="site_name_en">Tên website (English)</label>
        <input id="site_name_en" type="text" name="settings[site_name_en]" value="{{ old('settings.site_name_en', $settings['site_name_en'] ?? '') }}" style="width:100%; padding:8px;">
    </div>


    <div style="margin-bottom: 20px;">

        <label>
            Hotline
        </label>

        <input
            type="text"
            name="settings[hotline]"
            value="{{ old('settings.hotline', $settings['hotline'] ?? '') }}"
            style="width: 100%; padding: 8px;"
        >

    </div>


    <div style="margin-bottom: 20px;">

        <label>
            Email
        </label>

        <input
            type="email"
            name="settings[email]"
            value="{{ old('settings.email', $settings['email'] ?? '') }}"
            style="width: 100%; padding: 8px;"
        >

    </div>


    <div style="margin-bottom: 20px;">

        <label>
            Facebook URL
        </label>

        <input
            type="url"
            name="settings[facebook_url]"
            value="{{ old('settings.facebook_url', $settings['facebook_url'] ?? '') }}"
            style="width: 100%; padding: 8px;"
        >

    </div>


    <div style="margin-bottom: 20px;">

        <label>
            YouTube URL
        </label>

        <input
            type="url"
            name="settings[youtube_url]"
            value="{{ old('settings.youtube_url', $settings['youtube_url'] ?? '') }}"
            style="width: 100%; padding: 8px;"
        >

    </div>


    <div style="margin-bottom: 20px;">

        <label>
            Zalo URL
        </label>

        <input
            type="url"
            name="settings[zalo_url]"
            value="{{ old('settings.zalo_url', $settings['zalo_url'] ?? '') }}"
            style="width: 100%; padding: 8px;"
        >

    </div>


    <div style="margin-bottom: 20px;">

        <label>
            Địa chỉ Footer
        </label>

        <textarea
            name="settings[footer_address]"
            rows="3"
            style="width: 100%; padding: 8px;"
        >{{ old('settings.footer_address', $settings['footer_address'] ?? '') }}</textarea>

    </div>

    <div style="margin-bottom: 20px;">
        <label for="footer_address_en">Địa chỉ Footer (English)</label>
        <textarea id="footer_address_en" name="settings[footer_address_en]" rows="3" style="width:100%; padding:8px;">{{ old('settings.footer_address_en', $settings['footer_address_en'] ?? '') }}</textarea>
    </div>


    <div style="margin-bottom: 20px;">

        <label>
            Nội dung Footer
        </label>

        <textarea
            name="settings[footer_description]"
            rows="5"
            style="width: 100%; padding: 8px;"
        >{{ old('settings.footer_description', $settings['footer_description'] ?? '') }}</textarea>

    </div>

    <div style="margin-bottom: 20px;">
        <label for="footer_description_en">Nội dung Footer (English)</label>
        <textarea id="footer_description_en" name="settings[footer_description_en]" rows="5" style="width:100%; padding:8px;">{{ old('settings.footer_description_en', $settings['footer_description_en'] ?? '') }}</textarea>
    </div>


    <button type="submit">
        Lưu cài đặt
    </button>

</form>

@endsection