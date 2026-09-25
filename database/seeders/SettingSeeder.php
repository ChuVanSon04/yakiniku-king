<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Yakiniku King',

            'hotline' => '1900 1234',

            'email' => 'info@yakinikuking.vn',

            'facebook_url' => 'https://www.facebook.com/yakiniku.king.official',

            'x_url' => 'https://x.com/yakiniku_king_',

            'instagram_url' => 'https://www.instagram.com/yakiniku_king_official/',

            'footer_address' => 'Hà Nội, Việt Nam',

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
