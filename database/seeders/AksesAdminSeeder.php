<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Artisan;
use App\Models\User;

class AksesAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::findByName('admin');
        $role->syncPermissions(['Menu Admin', 'Role Maintenance','Role Management','Cabang','Create User','Print Report','Ganti Password Admin','Audit Trails','Menu User','Print QR']);
        $user = User::where('username','admin')->first();
        $user->assignRole('admin');
        Artisan::call('cache:clear');
    }
}
