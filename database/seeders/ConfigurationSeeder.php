<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert(
            [
                [
                    'key' => 'COMPANY_NAME',
                    'value' => 'Taman Dayu Golf Club & Resort'
                ],
                [
                    'key' => 'ADDRESS',
                    'value' => 'Jl. Raya Surabaya-Malang Km.48 Pandaan 67156 Pasuruan, East Java - Indonesia'
                ],
                [
                    'key' => 'PHONE_NUMBER',
                    'value' => '+62 343 674 1234'
                ],
                [
                    'key' => 'PHONE_NUMBER_2',
                    'value' => '+62 811 34 88 234'
                ],
                [
                    'key' => 'HOME_VIDEO_URL',
                    'value' => 'https://www.tamandayu.magnamediadesign.com/assets/video-header.mp4'
                ],
                [
                    'key' => 'EMAIL',
                    'value' => 'info@tamandayu.com'
                ]
            ]
    );
    }
}
