<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Artisan;
use App\Models\User;

class AksesCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::findByName('customer service');
        $role->syncPermissions(['Menu Admin','Print Report','Print QR','Ganti Password User']);
        $user = User::where('username','customer service')->first();
        $user->assignRole('customer service');
        Artisan::call('cache:clear');
    }
}
