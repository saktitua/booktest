<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Artisan;
use App\Models\User;

class AksesSupervisorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::findByName('supervisor');
        $role->syncPermissions(['Menu Admin','Create User Approval']);
        $user = User::where('username','supervisor')->first();
        $user->assignRole('supervisor');
        Artisan::call('cache:clear');
    }
}
