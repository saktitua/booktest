<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array(
            array('id' => '1','name' => 'Superadmin','username' => 'Superadmin','nik' => '00000','cabang_id' => '1','phone_number' => '00000000','status' => 'Aktif','confirmation_status' => 'Approved','email' => 'superadmin@markplus.com','email_verified_at' => NULL,'role' => 'superadmin','generate' => NULL,'password' =>hash::make('mark123'),'remember_token' => NULL,'created_at' => '2023-10-02 04:56:02','updated_at' => '2024-01-22 14:19:04'),
        );
          
        
        
        DB::table('users')->insert($users);    
    }
}
