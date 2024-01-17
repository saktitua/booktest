<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $report = array(
            array('id' => '1','cabang_id' => '23','role_id' => '1','user_id' => '3','nama' => 'Tina','date' => '2024-01-08','reason' => '-','created_at' => '2024-01-08 16:39:52','updated_at' => '2024-01-10 16:39:52'),
            array('id' => '2','cabang_id' => '23','role_id' => '1','user_id' => '3','nama' => 'Dono','date' => '2024-01-08','reason' => '-','created_at' => '2024-01-08 00:00:00','updated_at' => '2024-01-10 16:40:11'),
            array('id' => '3','cabang_id' => '23','role_id' => '1','user_id' => '3','nama' => 'Suri','date' => '2024-01-08','reason' => 'Oks','created_at' => '2024-01-08 16:40:27','updated_at' => '2024-01-10 16:40:27'),
            array('id' => '4','cabang_id' => '23','role_id' => '1','user_id' => '3','nama' => 'Suni','date' => '2024-01-10','reason' => 'Twar','created_at' => '2024-01-10 16:47:10','updated_at' => '2024-01-10 16:47:10'),
            array('id' => '5','cabang_id' => '23','role_id' => '1','user_id' => '3','nama' => 'Gagap','date' => '2024-01-10','reason' => 'Oks','created_at' => '2024-01-10 16:47:25','updated_at' => '2024-01-10 16:47:25')
        );
        DB::table('report')->insert($report);
          
    }
}
