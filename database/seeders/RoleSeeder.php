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
            array('id' => '1','name' => 'staff 1','guard_name' => 'staff 1','created_at' => '2023-10-05 05:42:28','updated_at' => '2023-10-05 05:42:28'),
            array('id' => '2','name' => 'customer service','guard_name' => 'cs','created_at' => '2023-10-05 05:42:38','updated_at' => '2023-10-05 05:42:38'),
            array('id' => '3','name' => 'admin','guard_name' => 'adm','created_at' => '2023-10-05 05:42:49','updated_at' => '2023-10-05 05:42:49'),
            array('id' => '4','name' => 'superadmin','guard_name' => 'spradmin','created_at' => '2023-10-05 05:43:06','updated_at' => '2023-10-05 05:43:06')
        );
        DB::table('roles')->insert($roles);
    }
}
