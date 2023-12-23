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
            'name'              => 'Rio Wirawan',
            'username'          => 'oriorasajambu',
            'email'             => 'oriorasajambu@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password'          => 'rio21011994',
            'gender'            => 'men',
            'position'          => 'Middle Web Developer',
            'phone_number'      => '082362200442',
            'address'           => 'Jalan Setiabudi Pasar 1 Komp. Puri Tanjung Sari No. 42',
            'city'              => 'Medan',
            'country'           => 'Indonesia',
        ]);
    }
}
