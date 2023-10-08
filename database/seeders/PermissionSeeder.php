<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = array(
            array('id' => '1','name' => 'Menu Admin','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '2','name' => 'Role Maintenance','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '3','name' => 'Role Management','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '4','name' => 'Create User','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '5','name' => 'Create User Approval','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '6','name' => 'Print Report','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '7','name' => 'Ganti Password Admin','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '8','name' => 'Audit Trails','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '9','name' => 'Menu User','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '10','name' => 'Edit Action','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '11','name' => 'Print QR','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
            array('id' => '12','name' => 'Ganti Password User','guard_name' => 'web','created_at' => date('Y-m-d h:i:s'),'updated_at' => date('Y-m-d h:i:s')),
        );  
        DB::table("permissions")->insert($permission); 
    }
}
