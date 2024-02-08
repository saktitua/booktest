<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Artisan;
use App\Models\User;

class AksesSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $role = Role::findByName('superadmin');
        $role->syncPermissions(['Menu Admin', 'Role Maintenance','Role Management','Cabang','Create User','Print Report','Question','Create User Approval','Ganti Password Admin','Audit Trails','Menu User','Edit Action','Print QR']);
        $user = User::where('role','superadmin')->first();
        $user->assignRole('superadmin');
        Artisan::call('cache:clear');
    }
}
