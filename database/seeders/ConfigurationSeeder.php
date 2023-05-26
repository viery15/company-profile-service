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
                    'label' => 'Company Name',
                    'value' => 'Taman Dayu Golf Club & Resort'
                ],
                [
                    'key' => 'ADDRESS',
                    'label' => 'Address',
                    'value' => 'Jl. Raya Surabaya-Malang Km.48 Pandaan 67156 Pasuruan, East Java - Indonesia'
                ],
                [
                    'key' => 'PHONE_NUMBER',
                    'label' => 'Phone Number',
                    'value' => '+62 343 674 1234'
                ],
                [
                    'key' => 'PHONE_NUMBER_2',
                    'label' => 'Phone Number 2',
                    'value' => '+62 811 34 88 234'
                ],
                [
                    'key' => 'EMAIL',
                    'label' => 'Email',
                    'value' => 'info@tamandayu.com'
                ]
            ]
    );
    }
}
