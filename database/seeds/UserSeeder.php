<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
        	['name' => 'Apoteker', 'email' => 'apoteker@gmail.com', 'no_telp' => '081234567890', 'password' => 'apoteker', 'role_id' => 1 ],
        	['name' => 'Pelanggan', 'email' => 'pelanggan@gmail.com', 'no_telp' => '081234565432', 'password' => 'pelanggan', 'role_id' => 2 ],
        ]);
    }
}
