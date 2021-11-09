<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    protected $data = [
        [
            'name' => "SSCC_REFERENCE",
            'setting' => "1",
            'active' => true,
            'comment' => "This is the SSCC serial reference number used for tracking and print pallet labels"
        ]
    ];
    /**
     * run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        foreach ($this->data as $data) {
            $node = Setting::create(
                $data
            );
        }
    }
}
