<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        $data[] = [
            'name' => "Quốc Pháp",
            'email' => "quocphap000@gmail.com",
            'password' => Hash::make('12345678'),
            'level' => 0
        ];


        $data[] = [
            'name' => "Tuệ Tĩnh",
            'email' => "tuetinh000@gmail.com",
            'password' => Hash::make('12345678'),
            'level' => 0
        ];


        DB::table('users')->insert($data);
    }
}
