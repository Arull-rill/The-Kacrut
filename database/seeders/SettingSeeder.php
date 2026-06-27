<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'website_name' => 'Band Website',
            'logo'         => '',
            'banner'       => '',
            'instagram'    => 'https://instagram.com/',
            'facebook'     => 'https://facebook.com/',
            'whatsapp'     => '6281234567890',
            'email'        => 'info@bandwebsite.com',
            'address'      => 'Bandung, Jawa Barat, Indonesia',
            'footer_text'  => '© 2025 Band Website. All Rights Reserved.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}