<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = array(
            array('id' => '1','name' => 'customer service','guard_name' => 'web','kode_role'=>'cs','created_at' => '2023-10-05 05:42:38','updated_at' => '2023-10-05 05:42:38'),
            array('id' => '2','name' => 'admin','guard_name' => 'web','kode_role'=>'adm','created_at' => '2023-10-05 05:42:49','updated_at' => '2023-10-05 05:42:49'),
            array('id' => '3','name' => 'superadmin','guard_name' => 'web','kode_role'=>'spr adm','created_at' => '2023-10-05 05:43:06','updated_at' => '2023-10-05 05:43:06'),
            array('id' => '4','name' => 'supervisor','guard_name' => 'web','kode_role'=>'spv','created_at' => '2023-10-05 05:43:06','updated_at' => '2023-10-05 05:43:06')
          );
        DB::table('roles')->insert($roles);
    }
}
