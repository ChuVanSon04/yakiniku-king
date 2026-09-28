<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'NHÀ HÀNG USSINA AGING BEEF & BAR',

            'hotline' => '1900 1234',

            'hotline_vn_jp' => '089.667.2861 (VN – JP)',

            'hotline_en' => '0287.307.9793 (EN)',

            'email' => 'ussina.landmark81@ussinavietnam.com',

            'facebook_url' => 'https://www.facebook.com/ussinavietnam',

            'x_url' => 'https://x.com/yakiniku_king_',

            'instagram_url' => 'https://www.instagram.com/yakiniku_king_official/',

            'footer_address' => 'Tầng L77, Tòa nhà Landmark 81, 720A Điện Biên Phủ, phường Thạnh Mỹ Tây, Thành phố Hồ Chí Minh, Việt Nam',

            'footer_description' => 'Yakiniku King - Nhà hàng thịt nướng phong cách Nhật Bản.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
