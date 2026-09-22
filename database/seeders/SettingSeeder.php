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

            'facebook_url' => '',

            'youtube_url' => '',

            'zalo_url' => '',

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
