<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'  =>  '1',
            'name'  =>  'Sujon Mia',
            'email'  =>  'sujonbdjoin019@gmail.com',
            'password'  =>  Hash::make('12345678'),
            'status'  =>  '1',
        ]);

        DB::table('users')->insert([
            'role_id'  =>  '2',
            'name'  =>  'Sirajul Islal',
            'email'  =>  'sujonbdjoin28783@gmail.com',
            'password'  =>  Hash::make('123456789'),
            'status'  =>  '1',
        ]);
    }
}
