<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $configs = [
            [
                'name' => 'language',
                'slug' => 'language',
                'value' => '["in","en","default"]',
            ],
            [
                'name' => 'tax',
                'slug' => 'tax',
                'value' => '["yes","no"]',
            ]
        ];
        foreach($configs as $config) {
            Config::create($config);
        }
    }
}
