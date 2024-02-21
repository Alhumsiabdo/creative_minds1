<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'abdullah',
                'email' => 'abdullah.alhumsi@gmail.com',
                'phone' => '+201054564562',
                'image' => 'assets/uploads/avatar.png',
                'password' => Hash::make('123456'),
                'type' => 'user',
                'latitude' => 25.44,
                'longitude' => 25.44,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'eldapour',
                'email' => 'abdullah.eldapour@gmail.com',
                'phone' => '+201054564566',
                'img' => 'assets/uploads/avatar.png',
                'password' => Hash::make('123456'),
                'type' => 'delivery',
                'latitude' => 33.14,
                'longitude' => 33.11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'eslam',
                'email' => 'eslam.mohammed@gmail.com',
                'phone' => '+201054564567',
                'img' => 'assets/uploads/avatar.png',
                'password' => Hash::make('123456'),
                'type' => 'user',
                'latitude' => 34.77,
                'longitude' => 88.02,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'ahmed',
                'email' => 'ahmed.alsabbagh@gmail.com',
                'phone' => '+201054564564',
                'img' => 'assets/uploads/avatar.png',
                'password' => Hash::make('123456'),
                'type' => 'delivery',
                'latitude' => 55.22,
                'longitude' => 44.11,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('users')->insert($data);
    }
}
