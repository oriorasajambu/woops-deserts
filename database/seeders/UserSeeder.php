<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'              => 'Wulanda Apriliani',
            'username'          => 'wulandaapriliani',
            'email'             => 'wulandaajha@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password'          => '030403',
            'gender'            => 'women',
            'position'          => 'Admin',
            'phone_number'      => '082277027943',
            'address'           => 'Jalan Gatot Subroto No.15 Sei Sikambing C Medan Helvetia',
            'city'              => 'Medan',
            'country'           => 'Indonesia',
        ]);
    }
}
