<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            CabangSeeder::class,
            AksesSuperAdminSeeder::class,
            // AksesAdminSeeder::class,
            AksesCustomerSeeder::class,
            // AksesSupervisorSeeder::class,
            QuestionSeeder::class,
            // ReportSeeder::class,
            // DetailReportSeeder::class,

        ]);
    }
}
