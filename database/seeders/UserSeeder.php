<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array(
            array('id' => '1','name' => 'superadmin','username' => 'superadmin','nik' => '000000','cabang_id' => '23','phone_number' => '000000','status' => 'Aktif','confirmation_status' => 'Approved','email' => 'superadmin@microsite.com','email_verified_at' => NULL,'role' => 'superadmin','generate' => NULL,'password' => '$2a$12$yCO3saWAUWvpuJCOZPr6xuCdKshpnsEVnWa9kovelHY7h0U6vmLna','remember_token' => NULL,'created_at' => '2023-10-02 04:56:02','updated_at' => '2023-10-02 04:56:02'),
            array('id' => '2','name' => 'Admin','username' => 'admin','nik' => '000000','cabang_id' => '23','phone_number' => '000000','status' => 'Aktif','confirmation_status' => 'Approved','email' => 'admin@microsite.com','email_verified_at' => NULL,'role' => 'admin','generate' => '9e002d47-da7c-46c5-8cc5-9d6d56c3fd62','password' => '$2a$12$yCO3saWAUWvpuJCOZPr6xuCdKshpnsEVnWa9kovelHY7h0U6vmLna','remember_token' => NULL,'created_at' => '2023-10-05 05:52:36','updated_at' => '2023-10-05 09:26:56'),
            array('id' => '3','name' => 'customer service','username' => 'customer service','nik' => '000000','cabang_id' => '23','phone_number' => '000000','status' => 'Aktif','confirmation_status' => 'Approved','email' => 'customer@microsite.com','email_verified_at' => NULL,'role' => 'customer service','generate' => 'b8069bc8-ecda-44d4-96a1-be8886048bb2','password' => '$2a$12$yCO3saWAUWvpuJCOZPr6xuCdKshpnsEVnWa9kovelHY7h0U6vmLna','remember_token' => NULL,'created_at' => '2023-10-05 18:34:40','updated_at' => '2023-10-05 18:34:40')
        );         
        DB::table('users')->insert($users);    
    }
}
