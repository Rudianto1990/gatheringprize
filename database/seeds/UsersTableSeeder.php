<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'superadmin@superadmin.com',
            'password' => bcrypt('superadmin'),
            'role' => 'superadmin'
        ]);

        DB::table('users')->insert([
            'name' => 'Admin Tabel',
            'email' => 'admintabel@admintabel.com',
            'password' => bcrypt('admintabel'),
            'role' => 'admintabel'
        ]);

        DB::table('users')->insert([
            'name' => 'Admin Roulette',
            'email' => 'adminroulette@adminroulette.com',
            'password' => bcrypt('adminroulette'),
            'role' => 'adminroulette'
        ]);
    }
}
