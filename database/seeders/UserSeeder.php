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
            array('id' => '1','name' => 'superadmin','username' => 'saktitua','nik' => '1211068','cabang_id' => '1','phone_number' => '81380223329','status' => 'Aktif','confirmation_status' => 'Approved','email' => 'superadmin@microsite.com','email_verified_at' => NULL,'role' => 'superadmin','generate' => NULL,'password' => '$2y$10$iVvJPf/b4G3dpH2EyGXxzuPk4Snuj/Y8qnvoXSR5slvxGcc1se7G.','remember_token' => NULL,'created_at' => '2023-10-02 04:56:02','updated_at' => '2023-10-02 04:56:02'),
            array('id' => '2','name' => 'sakti','username' => 'saktitua','nik' => '1211068','cabang_id' => '1','phone_number' => '81380223329','status' => 'Aktif','confirmation_status' => 'Approved','email' => 'saktitua@microsite','email_verified_at' => NULL,'role' => 'customer service','generate' => '9e002d47-da7c-46c5-8cc5-9d6d56c3fd62','password' => '$2y$10$.JkWKW99CZs6.446iYDBWOe/NoYb.jGgoABxklLLJpmIgLK3gILRO','remember_token' => NULL,'created_at' => '2023-10-05 05:52:36','updated_at' => '2023-10-05 09:26:56'),
            array('id' => '3','name' => 'llova','username' => 'martinalova','nik' => '1234342323','cabang_id' => '1','phone_number' => '81380223329','status' => NULL,'confirmation_status' => NULL,'email' => 'lova@microsite.com','email_verified_at' => NULL,'role' => 'customer service','generate' => 'b8069bc8-ecda-44d4-96a1-be8886048bb2','password' => '$2y$10$JR/e4WHkzHzcgSnaJi9XMOZ0yRdtZmgkN3sFufXwj2VPmgXoSGgUi','remember_token' => NULL,'created_at' => '2023-10-05 18:34:40','updated_at' => '2023-10-05 18:34:40')
        );         
        DB::table('users')->insert($users);
          
    }
}
